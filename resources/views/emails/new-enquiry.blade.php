# New moving enquiry

**Received:** {{ $lead->created_at->format('d M Y, h:i A') }}
**Lead ID:** #{{ $lead->id }}
**Source page:** {{ $lead->source_page ?: 'direct' }}

| Field | Detail |
| --- | --- |
| **Name** | {{ $lead->name }} |
| **Phone** | [{{ $lead->phone }}](tel:{{ $lead->phone }}) |
| **Email** | [{{ $lead->email }}](mailto:{{ $lead->email }}) |
| **Moving from** | {{ $lead->departure_city ?: '—' }} |
| **Moving to** | {{ $lead->delivery_city ?: '—' }} |
| **Preferred date** | {{ $lead->moving_date?->format('d M Y') ?: '—' }} |
| **Preferred time** | {{ $lead->moving_time ?: '—' }} |
| **Service** | {{ $lead->service ?: '—' }} |

@if ($lead->message)
### Customer message

> {!! nl2br(e($lead->message)) !!}
@endif

---

**Call back ASAP** — packers and movers enquiries go cold fast.

Reply to this email to reach {{ $lead->name }} directly.
