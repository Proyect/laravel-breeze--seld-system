<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServicioController extends Controller
{
    public function detalle($slug)
    {
        // Obtener configuración de servicios desde el archivo de configuración
        $servicios = config('servicios.servicios', []);
        
        if (!isset($servicios[$slug])) {
            abort(404, 'Servicio no encontrado');
        }
        
        $servicio = $servicios[$slug];
        
        // Agregar información adicional de tecnologías
        $servicio['tecnologias_info'] = $this->getTecnologiasInfo($servicio['tecnologias'] ?? []);
        
        return view('servicios.detalle', compact('servicio', 'slug'));
    }

    /**
     * Obtener información detallada de las tecnologías
     */
    private function getTecnologiasInfo($tecnologias)
    {
        $tecnologiasInfo = config('servicios.tecnologias_info', []);
        $info = [];
        
        foreach ($tecnologias as $tecnologia) {
            if (isset($tecnologiasInfo[$tecnologia])) {
                $info[$tecnologia] = $tecnologiasInfo[$tecnologia];
            } else {
                // Información por defecto si no está configurada
                $info[$tecnologia] = [
                    'descripcion' => 'Tecnología especializada para desarrollo profesional',
                    'documentacion' => '#',
                    'categoria' => 'general'
                ];
            }
        }
        
        return $info;
    }

    public function relevamiento(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensaje' => 'required|string',
            // Puedes agregar más campos personalizados aquí
        ]);

        // Enviar email de relevamiento
        Mail::raw(
            "Nuevo relevamiento para $slug de: {$validated['name']} ({$validated['email']})\n\nMensaje: {$validated['mensaje']}",
            function ($message) {
                $message->to('contacto@infrasoft.com.ar')
                        ->subject('Nuevo relevamiento de servicio');
            }
        );

        return back()->with('success', '¡Tu relevamiento fue enviado correctamente!');
    }

    /**
     * Obtener lista de todos los servicios disponibles
     */
    public function index()
    {
        $servicios = config('servicios.servicios', []);
        return view('servicios.index', compact('servicios'));
    }

    /**
     * Obtener tecnologías por categoría
     */
    public function tecnologiasPorCategoria($categoria)
    {
        $tecnologiasInfo = config('servicios.tecnologias_info', []);
        $categorias = config('servicios.categorias', []);
        
        $tecnologias = collect($tecnologiasInfo)
            ->filter(function ($info) use ($categoria) {
                return $info['categoria'] === $categoria;
            })
            ->keys()
            ->values();
        
        return response()->json([
            'categoria' => $categorias[$categoria] ?? $categoria,
            'tecnologias' => $tecnologias
        ]);
    }
} 