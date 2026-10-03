import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // Self-hosted via Bunny Fonts. The legacy site linked a malformed
            // Google Fonts URL that 404'd, so headings fell back to a random
            // system font. Bunny serves the same fonts with a GDPR-friendly
            // endpoint and better caching.
            fonts: [
                bunny('DM Sans', { weights: [400, 500, 600, 700] }),
                bunny('Rethink Sans', { weights: [500, 600, 700, 800] }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
