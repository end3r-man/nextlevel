@props([
    'source' => null,
    'heading' => 'Get a Free Fixed-Price Moving Quote',
    'lead' => 'Tell us your move details and preferred date. We provide a firm, itemized written price in 15 minutes — guaranteed no hidden charges on moving day.',
    'showImage' => true,
])

@php
    $site = config('site');
    $services = \App\Models\Service::active()->ordered()->pluck('name');
@endphp

{{-- =========================================================================
     QUOTE FORM COMPONENT: High-Converting Lead Capture
     ========================================================================= --}}
<section id="get-a-quote" class="relative overflow-hidden bg-[#f6f8fc] py-24 sm:py-28 lg:py-32">

    {{-- Background subtle ambient glow --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute left-1/2 bottom-0 h-96 w-[1000px] -translate-x-1/2 rounded-full bg-[#144b9e]/[0.03] blur-3xl"></div>
    </div>

    <div class="container-page">
        <div class="overflow-hidden rounded-[2rem] border border-slate-200/90 bg-white shadow-[0_20px_60px_-25px_rgba(8,27,53,0.12)] {{ $showImage ? 'lg:grid lg:grid-cols-12' : '' }}">

            @if ($showImage)
                {{-- Left Column: Trust Media, Phone Callout & Guarantees matching Hero aesthetic --}}
                <div class="relative isolate overflow-hidden bg-[#144b9e] p-8 sm:p-10 text-white flex flex-col justify-between lg:col-span-5">
                    
                    {{-- Decorative glows & grid --}}
                    <div class="pointer-events-none absolute inset-0 -z-10" aria-hidden="true">
                        <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white/[0.08] blur-2xl"></div>
                        <div class="absolute -left-20 -bottom-20 h-64 w-64 rounded-full bg-[#6ea8ff]/20 blur-2xl"></div>
                        <div class="absolute -right-24 bottom-1/3 h-56 w-56 rounded-full border border-white/[0.08]"></div>
                    </div>

                    <div class="relative">
                        <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-3.5 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-white/90 backdrop-blur-sm">
                            <span class="h-2 w-2 rounded-full bg-white"></span>
                            100% Free &amp; No Obligation
                        </div>

                        <h3 class="mt-6 text-2xl font-black sm:text-3xl text-white tracking-tight leading-snug">
                            Why Our Quotes Are 100% Reliable
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-white/75">
                            We calculate the exact vehicle volume, crew size, and packing material needed upfront so there are no surprise arguments on delivery day.
                        </p>

                        <div class="mt-8 space-y-4">
                            <div class="flex items-start gap-3 text-sm text-white/90">
                                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/15 text-white mt-0.5">
                                    ✓
                                </div>
                                <span><strong class="text-white">Written Price Lock:</strong> The quoted price is what you pay.</span>
                            </div>
                            <div class="flex items-start gap-3 text-sm text-white/90">
                                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/15 text-white mt-0.5">
                                    ✓
                                </div>
                                <span><strong class="text-white">Transit Insurance Included:</strong> 100% coverage for goods.</span>
                            </div>
                            <div class="flex items-start gap-3 text-sm text-white/90">
                                <div class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-white/15 text-white mt-0.5">
                                    ✓
                                </div>
                                <span><strong class="text-white">Fast Response:</strong> Call back within 15–30 minutes.</span>
                            </div>
                        </div>
                    </div>

                    {{-- Urgent Call / WhatsApp Box --}}
                    <div class="relative mt-10 rounded-3xl border border-white/20 bg-white/[0.08] p-6 backdrop-blur-md">
                        <p class="text-xs font-bold uppercase tracking-wider text-white/70">Need Immediate Assistance?</p>
                        <p class="mt-1 text-sm text-white/90">Speak directly to our relocation manager:</p>
                        <div class="mt-4 flex flex-col sm:flex-row gap-3">
                            <a href="tel:{{ $site['phone_e164'] }}"
                               class="group inline-flex flex-1 items-center justify-center gap-2 rounded-full bg-white px-5 py-3 text-xs font-bold text-[#144b9e] shadow-lg transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/95">
                                <x-icon name="phone" class="w-3.5 h-3.5" />
                                <span>{{ $site['phone_display'] }}</span>
                            </a>
                            <a href="{{ $site['whatsapp_url'] }}" target="_blank" rel="noopener"
                               class="inline-flex items-center justify-center gap-2 rounded-full border border-white/25 bg-white/10 px-5 py-3 text-xs font-bold text-white backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/20">
                                <x-icon name="whatsapp" class="w-3.5 h-3.5" />
                                <span>WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Right Column: Quote Form Fields --}}
            <div class="p-8 sm:p-10 lg:{{ $showImage ? 'col-span-7' : 'col-span-12' }}">
                <h2 class="text-2xl font-black sm:text-3xl text-[#081b35] tracking-tight">{{ $heading }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $lead }}</p>

                @if (session('success'))
                    <div role="status" class="mt-5 rounded-2xl bg-emerald-50 p-4 text-sm font-medium text-emerald-800 ring-1 ring-emerald-200">
                        {{ session('success') }}
                        @if (session('whatsapp_url'))
                            <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener"
                               class="mt-2.5 inline-flex items-center gap-2 font-bold text-emerald-700 underline">
                                <x-icon name="whatsapp" class="w-4 h-4" />
                                <span>Continue on WhatsApp for instant booking →</span>
                            </a>
                        @endif
                    </div>
                @endif

                <form method="post" action="{{ route('quote.store') }}"
                      data-quote-form class="mt-7 space-y-4" novalidate>
                    @csrf
                    <input type="hidden" name="source_page" value="{{ $source ?? request()->fullUrl() }}">

                    {{-- Honeypot field --}}
                    <div class="hidden" aria-hidden="true">
                        <label for="website">Website</label>
                        <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="q-name" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Your Full Name *</label>
                            <input type="text" id="q-name" name="name" required maxlength="120" autocomplete="name"
                                   placeholder="e.g. Anand Kumar"
                                   value="{{ old('name') }}"
                                   @class([
                                       'w-full rounded-2xl border bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10',
                                       'border-red-300' => $errors->has('name'),
                                       'border-slate-200' => ! $errors->has('name'),
                                   ])>
                            @error('name') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="q-phone" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Mobile Number (WhatsApp) *</label>
                            <input type="tel" id="q-phone" name="phone" required maxlength="32"
                                   inputmode="tel" autocomplete="tel" placeholder="e.g. 98765 43210"
                                   value="{{ old('phone') }}"
                                   @class([
                                       'w-full rounded-2xl border bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10',
                                       'border-red-300' => $errors->has('phone'),
                                       'border-slate-200' => ! $errors->has('phone'),
                                   ])>
                            @error('phone') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="q-email" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Email Address (Optional)</label>
                        <input type="email" id="q-email" name="email" maxlength="180"
                               autocomplete="email" placeholder="you@example.com"
                               value="{{ old('email') }}"
                               @class([
                                   'w-full rounded-2xl border bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10',
                                   'border-red-300' => $errors->has('email'),
                                   'border-slate-200' => ! $errors->has('email'),
                               ])>
                        @error('email') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="q-from" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Moving From (City / Area)</label>
                            <input type="text" id="q-from" name="departure_city" maxlength="120"
                                   placeholder="e.g. Erode / Chithode" value="{{ old('departure_city') }}"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10">
                            @error('departure_city') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="q-to" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Moving To (City / Area)</label>
                            <input type="text" id="q-to" name="delivery_city" maxlength="120"
                                   placeholder="e.g. Coimbatore / Gandhipuram" value="{{ old('delivery_city') }}"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10">
                            @error('delivery_city') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <label for="q-date" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Moving Date</label>
                            <input type="date" id="q-date" name="moving_date" value="{{ old('moving_date') }}"
                                   @class([
                                       'w-full rounded-2xl border bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10',
                                       'border-red-300' => $errors->has('moving_date'),
                                       'border-slate-200' => ! $errors->has('moving_date'),
                                   ])>
                            @error('moving_date') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="q-time" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Preferred Time</label>
                            <input type="text" id="q-time" name="moving_time" maxlength="40"
                                   placeholder="e.g. Morning 8 AM" value="{{ old('moving_time') }}"
                                   class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10">
                        </div>

                        <div>
                            <label for="q-service" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">Service Needed</label>
                            <select id="q-service" name="service"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10">
                                <option value="">Select Service (or Not sure)</option>
                                @foreach ($services as $serviceName)
                                    <option value="{{ $serviceName }}" @selected(old('service') === $serviceName)>{{ $serviceName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="q-msg" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-slate-700">
                            Move Details &amp; Special Items <span class="font-normal text-slate-400">(optional)</span>
                        </label>
                        <textarea id="q-msg" name="message" rows="2" maxlength="1500"
                                  placeholder="e.g. 2 BHK, 2nd floor with lift, double door fridge, wooden cot, bike shifting…"
                                  class="w-full resize-y rounded-2xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm text-[#081b35] outline-none transition focus:border-[#144b9e] focus:bg-white focus:ring-4 focus:ring-[#144b9e]/10">{{ old('message') }}</textarea>
                        @error('message') <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p> @enderror
                    </div>

                    <div data-form-messages aria-live="polite"></div>

                    <div class="pt-3 flex flex-col sm:flex-row items-center gap-4">
                        <button type="submit"
                                class="group inline-flex w-full sm:w-auto items-center justify-center rounded-full bg-[#144b9e] px-9 py-4 text-base font-bold text-white shadow-xl shadow-[#144b9e]/20 transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#103d80] cursor-pointer">
                            <span>Request My Free Quote</span>
                            <span class="ml-2 flex h-6 w-6 items-center justify-center rounded-full bg-white text-[#144b9e] transition-transform group-hover:translate-x-0.5 text-xs">
                                →
                            </span>
                        </button>

                        <span class="text-xs text-slate-500 text-center sm:text-left flex items-center gap-1.5">
                            <span>🔒</span> 100% privacy protected. No spam calls.
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

