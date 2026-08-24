<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string|max:5000',
        ]);

        $extra = collect([
            $validated['company'] ?? null ? 'Empresa: '.$validated['company'] : null,
            $validated['service'] ?? null ? 'Servicio: '.$validated['service'] : null,
        ])->filter()->implode("\n");

        $messageBody = $extra
            ? $extra."\n\n".$validated['message']
            : $validated['message'];

        Inquiry::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'message' => $messageBody,
            'status' => 'pending',
        ]);

        try {
            Mail::raw(
                "Nueva consulta de: {$validated['name']} ({$validated['email']})\n\n{$messageBody}",
                function ($message) {
                    $message->to(config('mail.from.address', 'contacto@infrasoft.com.ar'))
                        ->subject('Nueva consulta desde el sitio web');
                }
            );
        } catch (\Throwable $e) {
            Log::warning('No se pudo enviar el email de consulta', ['error' => $e->getMessage()]);
        }

        return back()->with('success', '¡Tu consulta fue enviada correctamente!');
    }
}
