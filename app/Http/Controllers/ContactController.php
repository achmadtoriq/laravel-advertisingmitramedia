<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ContactController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:150'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        $recipient = config('mail.contact_to', 'adm.mitramedia@gmail.com');

        try {
            Mail::send('emails.contact', ['data' => $data], function ($message) use ($data, $recipient) {
                $message
                    ->to($recipient)
                    ->replyTo($data['email'], $data['name'])
                    ->subject('Pesan Kontak Website: '.$data['subject']);
            });
        } catch (Throwable) {
            return back()
                ->withInput()
                ->withErrors([
                    'contact' => 'Pesan belum bisa dikirim. Silakan coba lagi atau hubungi kami lewat WhatsApp.',
                ]);
        }

        return back()->with('success', 'Pesan berhasil dikirim. Tim kami akan menghubungi Anda secepatnya.');
    }
}
