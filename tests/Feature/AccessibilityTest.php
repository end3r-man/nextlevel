<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Server-rendered accessibility contract.
 *
 * Only the parts that exist in the delivered HTML are asserted here. Behaviour
 * that lives in app.js (focus trapping, Escape handling, aria-controls wiring
 * on accordions) cannot be proven from markup and is covered by the JS.
 */
class AccessibilityTest extends TestCase
{
    public function test_every_page_offers_a_skip_link_to_the_main_landmark(): void
    {
        foreach (['/', '/services', '/contact-us'] as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            $this->assertStringContainsString('href="#main"', $html, "No skip link on {$url}");
            $this->assertStringContainsString('id="main"', $html, "No main landmark on {$url}");
            $this->assertStringContainsString('Skip to content', $html);
        }
    }

    public function test_document_declares_a_real_language(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        // The legacy site shipped lang="zxx", which is not a language code.
        $this->assertStringContainsString('<html lang="en-IN"', $html);
        $this->assertStringNotContainsString('lang="zxx"', $html);
    }

    public function test_mobile_menu_button_exposes_its_state(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('data-nav-open', $html);
        $this->assertStringContainsString('aria-controls="mobile-nav"', $html);
        $this->assertStringContainsString('aria-expanded="false"', $html);
        $this->assertStringContainsString('id="mobile-nav"', $html);
    }

    public function test_interactive_controls_are_real_buttons_or_links(): void
    {
        $html = $this->get('/faq')->assertOk()->getContent();

        // The legacy FAQ used div[onclick]. Interactive elements must be
        // natively focusable rather than divs with a click handler.
        $this->assertStringNotContainsString('<div onclick', $html);
        $this->assertStringNotContainsString('<span onclick', $html);

        preg_match_all('/<button\b[^>]*>/i', $html, $matches);
        $this->assertNotEmpty($matches[0]);

        foreach ($matches[0] as $button) {
            // Every button must declare its type. A <button> with no type
            // defaults to submit, so an accordion or lightbox control placed
            // inside a form would submit the quote form by accident.
            $this->assertMatchesRegularExpression(
                '/\btype="(button|submit|reset)"/i',
                $button,
                "Button without an explicit type: {$button}",
            );
        }

        // Submit buttons are legitimate, but only where a form actually is.
        preg_match_all('/<button\b[^>]*type="submit"[^>]*>/i', $html, $submits);
        $this->assertNotEmpty($submits[0]);
        $this->assertSame(
            substr_count($html, '<form'),
            count($submits[0]),
            'Every type="submit" button should sit inside a <form>',
        );
    }

    public function test_accordion_panels_start_collapsed(): void
    {
        $html = $this->get('/faq')->assertOk()->getContent();

        preg_match_all('/<button\b[^>]*data-accordion-trigger[^>]*>/i', $html, $triggers);
        $this->assertNotEmpty($triggers[0]);

        // Every trigger starts closed. Counting the attribute across the whole
        // page would also catch the mobile menu button's aria-expanded.
        foreach ($triggers[0] as $trigger) {
            $this->assertStringContainsString(
                'aria-expanded="false"',
                $trigger,
                "An accordion trigger is expanded on page load: {$trigger}",
            );
        }
    }

    public function test_forms_label_every_control(): void
    {
        $html = $this->get('/contact-us')->assertOk()->getContent();

        // Each input needs an id and a matching label, or an aria-label.
        preg_match_all('/<(?:input|select|textarea)\b[^>]*>/i', $html, $matches);

        $this->assertNotEmpty($matches[0]);

        foreach ($matches[0] as $field) {
            // Hidden inputs are never announced, so they need no label. The
            // honeypot is deliberately unlabelled so bots find nothing to fill.
            if (str_contains($field, 'type="hidden"')
                || str_contains($field, 'data-honeypot')
                || str_contains($field, 'name="website"')) {
                continue;
            }

            $hasAriaLabel = (bool) preg_match('/\baria-label=/i', $field);

            $id = preg_match('/\bid="([^"]+)"/i', $field, $m) ? $m[1] : null;

            $hasLabelFor = $id !== null && preg_match('/\bfor="'.preg_quote($id, '/').'"/i', $html);

            $this->assertTrue(
                $hasAriaLabel || $hasLabelFor,
                "Form control has no accessible name: {$field}",
            );
        }
    }

    public function test_decorative_images_are_hidden_from_screen_readers(): void
    {
        $html = $this->get('/contact-us')->assertOk()->getContent();

        // An image with alt="" must also be aria-hidden so it is not announced
        // as a focusable or labelled graphic.
        preg_match_all('/<img\b[^>]*alt=""[^>]*>/i', $html, $matches);

        foreach ($matches[0] as $img) {
            $this->assertStringContainsString(
                'aria-hidden',
                $img,
                "Decorative image without aria-hidden: {$img}",
            );
        }
    }

    public function test_links_that_open_new_tabs_are_safe(): void
    {
        foreach (['/', '/contact-us'] as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            preg_match_all('/<a\b[^>]*target="_blank"[^>]*>/i', $html, $matches);

            foreach ($matches[0] as $link) {
                $this->assertStringContainsString(
                    'rel="noopener',
                    $link,
                    "target=_blank without rel=noopener: {$link}",
                );
            }
        }
    }

    public function test_floating_contact_actions_are_labelled(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString('href="tel:+919363555311"', $html);
        $this->assertStringContainsString('aria-label="Call +91 93635 55311"', $html);
        $this->assertStringContainsString('wa.me/919363555311', $html);
    }
}
