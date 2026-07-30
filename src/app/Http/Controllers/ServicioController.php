<?php

namespace App\Http\Controllers;

use App\Mail\ServiceSurveyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ServicioController extends Controller
{
    public function detalle($slug)
    {
        $servicios = config('servicios.servicios', []);

        if (! isset($servicios[$slug])) {
            abort(404, 'Servicio no encontrado');
        }

        $servicio = $servicios[$slug];
        $servicio['tecnologias_info'] = $this->getTecnologiasInfo($servicio['tecnologias'] ?? []);

        return view('servicios.detalle', compact('servicio', 'slug'));
    }

    private function getTecnologiasInfo($tecnologias)
    {
        $tecnologiasInfo = config('servicios.tecnologias_info', []);
        $info = [];

        foreach ($tecnologias as $tecnologia) {
            if (isset($tecnologiasInfo[$tecnologia])) {
                $info[$tecnologia] = $tecnologiasInfo[$tecnologia];
            } else {
                $info[$tecnologia] = [
                    'descripcion' => 'Tecnología especializada para desarrollo profesional',
                    'documentacion' => '#',
                    'categoria' => 'general',
                ];
            }
        }

        return $info;
    }

    public function relevamiento(Request $request, $slug)
    {
        $servicios = config('servicios.servicios', []);
        if (! isset($servicios[$slug])) {
            abort(404, 'Servicio no encontrado');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string|max:5000',
        ]);

        try {
            Mail::to(config('mail.contact_to'))->send(new ServiceSurveyMail(
                $slug,
                $validated['name'],
                $validated['email'],
                $validated['mensaje'],
            ));
        } catch (\Throwable $e) {
            Log::error('Service survey mail failed', [
                'slug' => $slug,
                'message' => $e->getMessage(),
            ]);
        }

        return back()->with('success', '¡Tu relevamiento fue enviado correctamente!');
    }

    public function index()
    {
        $servicios = config('servicios.servicios', []);

        return view('servicios.index', compact('servicios'));
    }

    public function tecnologiasPorCategoria($categoria)
    {
        $tecnologiasInfo = config('servicios.tecnologias_info', []);
        $categorias = config('servicios.categorias', []);

        $tecnologias = collect($tecnologiasInfo)
            ->filter(fn ($info) => $info['categoria'] === $categoria)
            ->keys()
            ->values();

        return response()->json([
            'categoria' => $categorias[$categoria] ?? $categoria,
            'tecnologias' => $tecnologias,
        ]);
    }
}
