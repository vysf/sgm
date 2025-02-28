<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendContactForm (Request $request) {
        // validasi data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // kirim email

        // tampilkan pesan either success or fail
        try {
            Mail::to('cvsinargrahamitra@gmail.com')->queue(new ContactMail($data));
            // kirim pesan success
            return back()->with('success', 'Your message has been send successfully!');

        } catch (\Exception $e) {
            // Tangkap pengecualian dan log kesalahan jika pengiriman email gagal
            Log::error('Email sending failed: ' . $e->getMessage());
            
            return back()->with('error', 'Sorry, there was an issue sending your message. Please try agai later.');
        }
    }

    public function send(Request $request) {
        // validasi data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::to(env('MAIL_TO_ADDRESS'))->send(new ContactMail($data));
        
            return back()->with('success', 'Your message has been send successfully!');

        } catch (\Exception $e) {
            // Tangkap pengecualian dan log kesalahan jika pengiriman email gagal
            Log::error('Email sending failed: ' . $e->getMessage());
            
            return back()->with('error', 'Sorry, there was an issue sending your message. Please try agai later.');
        }
    }
}
