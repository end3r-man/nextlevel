<?php

namespace App\Http\Controllers;

use App\Mail\NewEnquiry;
use App\Models\Lead;
use App\Models\Service;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index(): View
    {
        $services = Service::active()->ordered()->get();
        $site = config('site');

        $title = 'Contact Us | Packers and Movers in Erode, Tiruppur & Coimbatore';
        $description = 'Get a free written moving quote from Next Level Packers and Movers. Call '
            .$site['phone_display'].' or send an enquiry — we reply the same day from our office in Chithode, Erode.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Contact', 'url' => route('contact')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('contact')),
            SchemaBuilder::breadcrumbs($crumbs),
            SchemaBuilder::contactPage($site),
        ];

        return view('contact', compact('services', 'title', 'description', 'schema', 'crumbs'));
    }

    public function store(Request $request): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:180'],
            // Indian mobile numbers, 10 digits, optionally +91 prefixed.
            'phone' => ['required', 'string', 'max:32', 'regex:/^(\+?91[\s-]?)?[6-9]\d{9}$/'],
            'departure_city' => ['nullable', 'string', 'max:120'],
            'delivery_city' => ['nullable', 'string', 'max:120'],
            'moving_date' => ['nullable', 'date', 'after_or_equal:today'],
            'moving_time' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:120'],
            'message' => ['nullable', 'string', 'max:1500'],
            // Honeypot. Bots fill every field; humans never see this one.
            'website' => ['prohibited'],
        ], [
            'phone.regex' => 'Enter a valid 10-digit Indian mobile number.',
            'website.prohibited' => 'Spam detected.',
        ]);

        $lead = Lead::create([
            ...$data,
            'source_page' => Str::limit($request->input('source_page') ?: $request->header('referer'), 255),
            'ip_address' => $request->ip(),
        ]);

        // Email is best-effort: a mail server hiccup must not lose a lead that
        // is already safely in the database. We notify, then decide what to do
        // with the result.
        try {
            Mail::to(config('site.leads.notify_email'))->send(new NewEnquiry($lead));
        } catch (\Throwable $e) {
            Log::error('Lead notification email failed', [
                'lead_id' => $lead->id,
                'error' => $e->getMessage(),
            ]);
        }

        $whatsappUrl = 'https://wa.me/'.config('site.whatsapp_number').'?text='.rawurlencode($lead->whatsappMessage());

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'message' => 'Thank you! Your enquiry has been received. We will call you back shortly.',
                'whatsapp_url' => $whatsappUrl,
            ]);
        }

        return back()
            ->with('success', 'Thank you! Your enquiry has been received. We will call you back shortly.')
            ->with('whatsapp_url', $whatsappUrl);
    }
}
