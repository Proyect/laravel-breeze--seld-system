<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Guardar en la base de datos
        $inquiry = Inquiry::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'pending',
        ]);

        // Enviar email de notificación (a tu correo)
        Mail::raw(
            "Nueva consulta de: {$validated['name']} ({$validated['email']})\n\nMensaje: {$validated['message']}",
            function ($message) {
                $message->to('conacto@infrasoft.com.ar')
                        ->subject('Nueva consulta desde el sitio web');
            }
        );

        return back()->with('success', '¡Tu consulta fue enviada correctamente!');
    }
} 