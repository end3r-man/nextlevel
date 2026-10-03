/**
 * Iconify -> inline SVG build step.
 *
 * Scans Blade templates for icon references and emits only the SVG data that is
 * actually used into resources/icons.php. This keeps icons server-rendered
 * (no runtime Iconify CDN request, no layout shift, crawlable markup) while
 * still shipping the whole Iconify catalogue as the source of truth.
 */
import { readFileSync, writeFileSync, readdirSync, statSync, existsSync } from 'node:fs';
import { join, dirname } from 'node:path';
import { fileURLToPath } from 'node:url';

const root = dirname(dirname(fileURLToPath(import.meta.url)));
// Seeders are scanned too: service/location icons live in PHP arrays there,
// so a renamed Iconify glyph is caught at build time instead of rendering
// a missing icon on 300 pages.
const searchRoots = [
    join(root, 'resources/views'),
    join(root, 'app'),
    join(root, 'database/seeders'),
];
const outFile = join(root, 'resources/icons.php');

// Icon aliases: short, memorable names mapped to an iconify set + icon.
const ALIASES = {
    'menu': 'ph:list-bold',
    'close': 'ph:x-bold',
    'phone': 'ph:phone-fill',
    'whatsapp': 'ph:whatsapp-logo-fill',
    'mail': 'ph:envelope-simple-fill',
    'pin': 'ph:map-pin-fill',
    'clock': 'ph:clock-fill',
    'arrow-right': 'ph:arrow-right-bold',
    'arrow-left': 'ph:arrow-left-bold',
    'chevron-right': 'ph:caret-right-bold',
    'chevron-down': 'ph:caret-down-bold',
    'check': 'ph:check-bold',
    'check-circle': 'ph:check-circle-fill',
    'star': 'ph:star-fill',
    'quote': 'ph:quotes-fill',
    'shield': 'ph:shield-check-fill',
    'truck': 'ph:truck-fill',
    'house': 'ph:house-line-fill',
    'building': 'ph:buildings-fill',
    'box': 'ph:package-fill',
    'warehouse': 'ph:warehouse-fill',
    'globe': 'ph:globe-hemisphere-west-fill',
    'box-open': 'ph:package-fill',
    'motorcycle': 'ph:motorcycle-fill',
    'arrows-left-right': 'ph:arrows-left-right-bold',
    'users': 'ph:users-three-fill',
    'calendar': 'ph:calendar-check-fill',
    'gauge': 'ph:gauge-fill',
    'medal': 'ph:medal-fill',
    'handshake': 'ph:handshake-fill',
    'gear': 'ph:gear-fill',
    'headset': 'ph:headset-fill',
    'spinner': 'ph:spinner-gap-fill',
    'clipboard': 'ph:clipboard-text-fill',
    'truck-fast': 'ph:truck-fill',
    'bed': 'ph:bed-fill',
    'sofa': 'ph:couch-fill',
    'plant': 'ph:plant-fill',
    'warning': 'ph:warning-fill',
    'info': 'ph:info-fill',
    'book': 'ph:book-open-fill',
    'copy': 'ph:copy-bold',
    'external': 'ph:arrow-square-out-bold',
    'route': 'ph:map-trifold-fill',
    'user': 'ph:user-fill',
    'plus': 'ph:plus-bold',
    'minus': 'ph:minus-bold',
    'map': 'ph:map-trifold-fill',
    'image': 'ph:image-fill',
    'play': 'ph:play-fill',
    'file-text': 'ph:file-text-fill',
    'tag': 'ph:tag-fill',
    'ruler': 'ph:ruler-fill',
    'briefcase': 'ph:briefcase-fill',
    'lock': 'ph:lock-key-fill',
    'scanner': 'ph:barcode-fill',
    'crate': 'ph:archive-fill',
    'stairs': 'ph:stairs-fill',
    'fuel': 'ph:gauge-fill',
    'timer': 'ph:timer-fill',
    'medal-star': 'ph:seal-check-fill',
    'facebook': 'ph:facebook-logo-fill',
    'twitter': 'ph:x-logo',
    'instagram': 'ph:instagram-logo-fill',
    'youtube': 'ph:youtube-logo-fill',
    'whatsapp-brand': 'ph:whatsapp-logo-fill',
};

function* walk(dir) {
    if (!statSync(dir, { throwIfNoEntry: false })?.isDirectory()) return;
    for (const entry of readdirSync(dir, { withFileTypes: true })) {
        const full = join(dir, entry.name);
        if (entry.isDirectory()) yield* walk(full);
        else if (/\.(blade\.php|php)$/.test(entry.name)) yield full;
    }
}

/**
 * Prefixes we are allowed to treat as icon references.
 *
 * Only Iconify sets actually installed in node_modules qualify. Without this
 * guard the dynamic scan below also matches Tailwind breakpoints ("lg:col-span-4")
 * and Open Graph property names ("og:image"), which then blow up the build.
 */
const installedPrefixes = new Set(
    readdirSync(join(root, 'node_modules/@iconify-json'), { withFileTypes: true })
        .filter((e) => e.isDirectory())
        .map((e) => e.name),
);

const requested = new Set();

for (const searchRoot of searchRoots) {
    for (const file of walk(searchRoot)) {
        const contents = readFileSync(file, 'utf8');
        // <x-icon name="foo" /> and <x-icon name='foo'>
        for (const match of contents.matchAll(/<x-icon\b[^>]*\bname=(?:"([^"]+)"|'([^']+)'|:\w+\s*=\s*(?:"([^"]+)"|'([^']+)'))/g)) {
            const name = match[1] ?? match[2] ?? match[3] ?? match[4];
            if (name) requested.add(name.trim());
        }
        // Dynamic: <x-icon :name="$icon" /> pairs resolved from @php blocks and
        // service/location seeders, e.g. ["lucide:truck", ...]
        for (const match of contents.matchAll(/['"]([a-z0-9-]+):([a-z0-9-]+)['"]/g)) {
            if (installedPrefixes.has(match[1])) requested.add(`${match[1]}:${match[2]}`);
        }
        // Icons picked from an array inside @php, e.g.
        // @foreach ([['medal', 'Why us'], ...] as [$icon, $heading])
        //     <x-icon :name="$icon" />
        // Those are bare alias names, not "set:icon", so they need their own pass.
        for (const match of contents.matchAll(/['"]([a-z][a-z0-9-]{1,30})['"]/g)) {
            if (ALIASES[match[1]]) requested.add(match[1]);
        }
    }
}

const names = new Set();
for (const name of requested) {
    if (ALIASES[name]) {
        names.add(ALIASES[name]);
        continue;
    }
    const [prefix, icon] = name.split(':');
    if (prefix && icon && installedPrefixes.has(prefix)) names.add(name);
}

const cache = new Map();
function loadSet(prefix) {
    if (cache.has(prefix)) return cache.get(prefix);

    const file = join(root, 'node_modules/@iconify-json', prefix, 'icons.json');
    if (!existsSync(file)) {
        console.error(`[icons] icon set "${prefix}" is not installed. Run: npm install @iconify-json/${prefix}`);
        process.exit(1);
    }

    const set = JSON.parse(readFileSync(file, 'utf8'));
    cache.set(prefix, set);
    return set;
}

const resolved = {};
const missing = [];

for (const name of [...names].sort()) {
    const [prefix, icon] = name.split(':');
    const set = loadSet(prefix);
    const found = set.icons[icon];
    if (!found) {
        missing.push(name);
        continue;
    }
    resolved[name] = {
        body: found.body,
        width: found.width ?? set.width ?? 256,
        height: found.height ?? set.height ?? 256,
    };
}

/**
 * Emit a PHP array literal.
 *
 * JSON.stringify() cannot be used here: JSON object syntax is not valid PHP
 * ("return { ... }" is a parse error), and shipping that would break every page
 * that renders an icon.
 */
function phpString(value) {
    return `'${value.replace(/\\/g, '\\\\').replace(/'/g, "\\'")}'`;
}

function phpValue(value, indent = 0) {
    const pad = ' '.repeat(indent + 4);

    if (Array.isArray(value)) {
        if (!value.length) return '[]';
        const items = value.map((item) => pad + phpValue(item, indent + 4));
        return `[\n${items.join(',\n')}\n${' '.repeat(indent)}]`;
    }

    if (value && typeof value === 'object') {
        const items = Object.entries(value).map(
            ([key, item]) => `${pad}${phpString(key)} => ${phpValue(item, indent + 4)},`,
        );
        return `[\n${items.join('\n')}\n${' '.repeat(indent)}]`;
    }

    if (typeof value === 'number') return String(value);
    if (typeof value === 'boolean') return value ? 'true' : 'false';

    return phpString(String(value));
}

const count = Object.keys(resolved).length;

// Emit the alias map too. Blade asks for short names ("pin"), so the component
// needs alias -> set:icon to find the right SVG at render time.
const usedAliases = {};
for (const name of requested) {
    const target = ALIASES[name];
    if (target && resolved[target]) usedAliases[name] = target;
}

const php = `<?php

declare(strict_types=1);

/*
 * AUTO-GENERATED by scripts/build-icons.mjs — do not edit by hand.
 * Run \`npm run icons\` (or \`npm run build\`) to regenerate.
 *
 * ${count} inline Iconify icons across ${Object.keys(usedAliases).length} aliases:
 * ${Object.keys(resolved).sort().join(', ')}
 *
 * @return array{icons: array<string, array{body: string, width: int, height: int}>, aliases: array<string, string>}
 */

return [
    'icons' => ${phpValue(resolved)},
    'aliases' => ${phpValue(usedAliases)},
];
`;

writeFileSync(outFile, php);

if (missing.length > 0) {
    console.error(`[icons] ${missing.length} unresolved: ${missing.join(', ')}`);
    process.exitCode = 1;
}

console.log(`[icons] ${Object.keys(resolved).length} icons written to resources/icons.php`);
