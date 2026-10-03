<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'departure_city',
        'delivery_city',
        'moving_date',
        'moving_time',
        'service',
        'message',
        'source_page',
        'ip_address',
    ];

    protected $casts = [
        'moving_date' => 'date',
    ];

    /** Normalised, human-friendly summary used by the WhatsApp deep link. */
    public function whatsappMessage(): string
    {
        $lines = [
            "Hi, I'm {$this->name}.",
            'I would like a moving quote from Next Level Packers & Movers.',
        ];

        if ($this->phone) {
            $lines[] = "Phone: {$this->phone}";
        }

        if ($this->departure_city || $this->delivery_city) {
            $lines[] = 'Moving from '.($this->departure_city ?: '—').' to '.($this->delivery_city ?: '—');
        }

        if ($this->moving_date) {
            $lines[] = 'Moving date: '.$this->moving_date->format('d M Y');
        }

        if ($this->service) {
            $lines[] = "Service: {$this->service}";
        }

        return implode("\n", $lines);
    }
}
