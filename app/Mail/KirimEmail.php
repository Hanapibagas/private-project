<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $status;
    public $nama;

    public function __construct(string $status, string $nama)
    {
        $this->status = $status;
        $this->nama = $nama;
    }

    public function build()
    {
        $status = $this->status;
        $nama = $this->nama;
        return $this->subject('Coupon anda', $status)->markdown('components.admin.cupon.send-coupon', compact('status', 'nama'));
    }
}
