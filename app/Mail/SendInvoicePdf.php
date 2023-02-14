<?php

namespace App\Mail;

use App\Models\BusinessDocument;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInvoicePdf extends Mailable
{
    use Queueable, SerializesModels;

    public BusinessDocument $businessDocument;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(BusinessDocument $businessDocument)
    {
        $this->businessDocument = $businessDocument;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
//            from: new Address('fakturynka@int.mk-home.pl'),
            subject: 'Twoja faktura',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.invoice.send_pdf',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        $pdf = PDF::loadView('documentPDF', ['businessDocument' => $this->businessDocument]);

        return [
            Attachment::fromData(fn () => $pdf->output(), 'Faktura.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
