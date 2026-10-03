<?php

namespace Tests\Feature;

use App\Mail\NewEnquiry;
use App\Models\Lead;
use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Illuminate\Support\Facades\Mail;
use Mockery;
use PHPUnit\Framework\Attributes\DataProvider;
use RuntimeException;
use Tests\TestCase;

class LeadSubmissionTest extends TestCase
{
    /** @return array<string, string> */
    private function validPayload(array $overrides = []): array
    {
        return [
            'name' => 'Prakash Kumar',
            'email' => 'prakash@example.com',
            'phone' => '9876543210',
            'departure_city' => 'Erode',
            'delivery_city' => 'Coimbatore',
            'moving_date' => now()->addDays(20)->toDateString(),
            'moving_time' => 'Morning',
            'service' => 'House Shifting',
            'message' => '2 BHK, third floor with lift.',
            'source_page' => '/contact-us',
            ...$overrides,
        ];
    }

    public function test_a_valid_enquiry_is_stored_and_notified(): void
    {
        Mail::fake();

        $response = $this->postJson(route('quote.store'), $this->validPayload());

        $response->assertOk()
            ->assertJson(['ok' => true])
            ->assertJsonStructure(['message', 'whatsapp_url']);

        $this->assertDatabaseHas('leads', [
            'name' => 'Prakash Kumar',
            'email' => 'prakash@example.com',
            'phone' => '9876543210',
            'departure_city' => 'Erode',
            'delivery_city' => 'Coimbatore',
            'source_page' => '/contact-us',
        ]);

        // NewEnquiry implements ShouldQueue, so Mail::fake() records it as
        // queued rather than sent.
        Mail::assertQueued(NewEnquiry::class, fn (NewEnquiry $mail) => $mail->hasTo(config('site.leads.notify_email')));
    }

    public function test_whatsapp_continuation_link_is_returned(): void
    {
        Mail::fake();

        $response = $this->postJson(route('quote.store'), $this->validPayload());

        $url = $response->json('whatsapp_url');

        $this->assertStringStartsWith('https://wa.me/'.config('site.whatsapp_number').'?text=', $url);
        $this->assertStringContainsString(urlencode('Prakash'), $url);
    }

    public function test_a_broken_mail_server_does_not_lose_the_lead(): void
    {
        // No built-in "make mail fail" helper exists, so stand in a mailer
        // that throws the way a real SMTP outage would.
        $failingMailer = Mockery::mock(MailerContract::class);
        $failingMailer->shouldReceive('send')->andThrow(new RuntimeException('SMTP is down'));

        Mail::swap($failingMailer);

        $this->postJson(route('quote.store'), $this->validPayload())->assertOk();

        // The lead is the business. Email is best effort.
        $this->assertDatabaseCount('leads', 1);
    }

    public static function invalidPayloads(): array
    {
        return [
            'missing name' => ['name', ['name' => '']],
            'missing email' => ['email', ['email' => '']],
            'bad email' => ['email', ['email' => 'not-an-email']],
            'missing phone' => ['phone', ['phone' => '']],
            'landline phone' => ['phone', ['phone' => '044 2222 3333']],
            'too short phone' => ['phone', ['phone' => '98765']],
            'date in the past' => ['moving_date', ['moving_date' => now()->subDay()->toDateString()]],
            'overlong name' => ['name', ['name' => str_repeat('a', 121)]],
            'overlong message' => ['message', ['message' => str_repeat('a', 1501)]],
        ];
    }

    #[DataProvider('invalidPayloads')]
    public function test_invalid_payloads_are_rejected(string $field, array $overrides): void
    {
        Mail::fake();

        $this->postJson(route('quote.store'), $this->validPayload($overrides))
            ->assertStatus(422)
            ->assertJsonValidationErrors($field);

        // A rejected enquiry must never reach the database or the inbox.
        $this->assertDatabaseCount('leads', 0);

        Mail::assertNothingSent();
    }

    public function test_accepted_phone_formats(): void
    {
        Mail::fake();

        // Mirrors the controller regex: optional 91 prefix with at most one
        // separator, then a 10-digit number starting 6-9.
        foreach (['9876543210', '+919876543210', '91 9876543210', '+91-9876543210'] as $phone) {
            $this->postJson(route('quote.store'), $this->validPayload(['phone' => $phone]))
                ->assertOk();
        }

        $this->assertDatabaseCount('leads', 4);
    }

    public function test_phone_numbers_that_look_plausible_but_are_invalid_are_rejected(): void
    {
        Mail::fake();

        // A mid-number space, a landline, a 9-digit number and a number
        // starting with 5 all pass a naive "is it digits" check.
        foreach (['91 98765 43210', '987654321', '5123456789', '1234567890'] as $phone) {
            $this->postJson(route('quote.store'), $this->validPayload(['phone' => $phone]))
                ->assertStatus(422)
                ->assertJsonValidationErrors('phone');
        }

        $this->assertDatabaseCount('leads', 0);
    }

    public function test_the_honeypot_rejects_bots_without_saving_anything(): void
    {
        Mail::fake();

        $this->postJson(route('quote.store'), $this->validPayload([
            'website' => 'https://spam.example',
        ]))->assertStatus(422);

        $this->assertDatabaseCount('leads', 0);

        Mail::assertNothingSent();
    }

    public function test_non_json_submission_redirects_back_with_a_success_message(): void
    {
        Mail::fake();

        $this->from('/contact-us')
            ->post(route('quote.store'), $this->validPayload())
            ->assertRedirect('/contact-us')
            ->assertSessionHas('success');

        $this->assertDatabaseCount('leads', 1);
    }

    public function test_the_legacy_enquiry_endpoint_still_accepts_submissions(): void
    {
        Mail::fake();

        $this->postJson(route('enquiry.store'), $this->validPayload())->assertOk();

        $this->assertDatabaseCount('leads', 1);
    }

    public function test_lead_model_builds_a_useful_whatsapp_message(): void
    {
        $lead = Lead::create($this->validPayload());

        $message = $lead->whatsappMessage();

        $this->assertStringContainsString('Prakash Kumar', $message);
        $this->assertStringContainsString('9876543210', $message);
        $this->assertStringContainsString('Erode', $message);
        $this->assertStringContainsString('Coimbatore', $message);
    }
}
