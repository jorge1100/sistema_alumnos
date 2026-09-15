<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'subject' => ['required', 'max:255'],
            'message' => ['required'],
        ]);

        ContactMessage::create($validated);

        Mail::to('admin@sistemaalumnos.com')->send(
            new ContactMail($validated)
        );

        return back()->with(
            'success',
            'Mensaje enviado correctamente.'
        );
    }
}