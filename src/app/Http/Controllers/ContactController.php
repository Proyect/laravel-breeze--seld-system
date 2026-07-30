<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        $recipient = config('mail.contact_to');

        try {
            Mail::raw(
                "Nueva consulta de: {$validated['name']} ({$validated['email']})\n\nMensaje: {$validated['message']}",
                function ($message) use ($recipient) {
                    $message->to($recipient)
                        ->subject('Nueva consulta desde el sitio web');
                }
            );
        } catch (\Throwable $e) {
            Log::error('Contact mail failed', [
                'inquiry_id' => $inquiry->id,
                'message' => $e->getMessage(),
            ]);
        }

        return back()->with('success', '¡Tu consulta fue enviada correctamente!');
    }
}
