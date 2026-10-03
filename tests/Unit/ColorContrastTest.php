<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Contrast contract for the palette in resources/css/app.css.
 *
 * This exists because the templates used ink-300/ink-400 for muted text on
 * white backgrounds, which measures 2.02:1 and 3.22:1 — both below the WCAG
 * AA 4.5:1 threshold for body text. Those tokens are still legitimate for
 * dark sections and for large text, so the fix is a documented split rather
 * than re-colouring the palette.
 */
class ColorContrastTest extends TestCase
{
    private const WHITE = '#ffffff';

    /** @var array<string, string> */
    private static array $tokens = [];

    public static function setUpBeforeClass(): void
    {
        $css = file_get_contents(dirname(__DIR__, 2).'/resources/css/app.css');

        preg_match_all('/--color-([a-z]+-\d+):\s*(#[0-9a-fA-F]{6})/', $css, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            self::$tokens[$match[1]] = $match[2];
        }
    }

    private static function luminance(string $hex): float
    {
        $hex = ltrim($hex, '#');

        // hexdec(), not (int): (int) "4d" is 4, it does not read the hex.
        [$r, $g, $b] = array_map(
            static fn (int $offset): int => (int) hexdec(substr($hex, $offset, 2)),
            [0, 2, 4],
        );

        $channel = static fn (int $value): float => $value / 255;
        $linear = static fn (float $c): float => $c <= 0.04045 ? $c / 12.92 : (($c + 0.055) / 1.055) ** 2.4;

        return 0.2126 * $linear($channel($r))
            + 0.7152 * $linear($channel($g))
            + 0.0722 * $linear($channel($b));
    }

    public static function contrast(string $a, string $b): float
    {
        [$lighter, $darker] = [self::luminance($a), self::luminance($b)];
        [$high, $low] = $lighter > $darker ? [$lighter, $darker] : [$darker, $lighter];

        return ($high + 0.05) / ($low + 0.05);
    }

    /** Tokens used for body or muted text on a light background. */
    #[DataProvider('lightBackgroundTextTokens')]
    public function test_light_background_text_meets_aa_on_white(string $token): void
    {
        $ratio = self::contrast(self::$tokens[$token], self::WHITE);

        $this->assertGreaterThanOrEqual(
            4.5,
            $ratio,
            sprintf('%s (%s) is %.2f:1 on white, below the 4.5:1 AA threshold for body text', $token, self::$tokens[$token], $ratio),
        );
    }

    /** @return array<string, array{string}> */
    public static function lightBackgroundTextTokens(): array
    {
        return [
            'ink-500' => ['ink-500'],
            'ink-600' => ['ink-600'],
            'ink-700' => ['ink-700'],
            'ink-800' => ['ink-800'],
            'ink-900' => ['ink-900'],
            'brand-600' => ['brand-600'],
            'brand-700' => ['brand-700'],
            'brand-800' => ['brand-800'],
            'accent-700' => ['accent-700'],
        ];
    }

    /**
     * Large text (>=24px) and meaningful icons only need 3:1. These tokens are
     * the ones still used on light backgrounds for that purpose.
     */
    #[DataProvider('largeTextAndIconTokens')]
    public function test_large_text_and_icon_tokens_clear_three_to_one(string $token): void
    {
        $ratio = self::contrast(self::$tokens[$token], self::WHITE);

        $this->assertGreaterThanOrEqual(
            3.0,
            $ratio,
            sprintf('%s (%s) is %.2f:1 on white, below the 3:1 threshold for large text and icons', $token, self::$tokens[$token], $ratio),
        );
    }

    /** @return array<string, array{string}> */
    public static function largeTextAndIconTokens(): array
    {
        return [
            'ink-400' => ['ink-400'],
            'brand-400' => ['brand-400'],
            'brand-500' => ['brand-500'],
            'accent-500' => ['accent-500'],
            'accent-600' => ['accent-600'],
        ];
    }

    /**
     * ink-300 (2.02:1) and accent-400 (2.84:1) cannot clear any threshold on
     * white, so they are restricted to the dark sections — the footer, the top
     * bar, the hero and the contact panel. This asserts that restriction holds
     * on both dark surfaces actually used.
     */
    #[DataProvider('darkSurfaceOnlyTokens')]
    public function test_dark_surface_only_tokens_meet_aa_on_dark_surfaces(string $token): void
    {
        foreach (['ink-950', 'brand-950'] as $surface) {
            $ratio = self::contrast(self::$tokens[$token], self::$tokens[$surface]);

            $this->assertGreaterThanOrEqual(
                4.5,
                $ratio,
                sprintf('%s (%s) is %.2f:1 on %s, below 4.5:1', $token, self::$tokens[$token], $ratio, $surface),
            );
        }
    }

    /** @return array<string, array{string}> */
    public static function darkSurfaceOnlyTokens(): array
    {
        return [
            'ink-300' => ['ink-300'],
            'ink-400' => ['ink-400'],
            'brand-400' => ['brand-400'],
            'accent-400' => ['accent-400'],
            'accent-500' => ['accent-500'],
        ];
    }

    public function test_palette_tokens_are_all_well_formed(): void
    {
        $this->assertNotEmpty(self::$tokens, 'No --color-* tokens parsed from app.css');

        foreach (self::$tokens as $name => $hex) {
            $this->assertMatchesRegularExpression(
                '/^#[0-9a-f]{6}$/i',
                $hex,
                "Token {$name} is not a 6-digit hex colour: {$hex}",
            );
        }
    }
}
