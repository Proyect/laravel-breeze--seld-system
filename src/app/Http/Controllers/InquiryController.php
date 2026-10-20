<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Inquiry::class);

        return view('inquiries.index');
    }

    public function list(): JsonResponse
    {
        $this->authorize('viewAny', Inquiry::class);

        return response()->json(
            Inquiry::latest()->get()
        );
    }

    public function update(Request $request, Inquiry $inquiry): JsonResponse
    {
        $this->authorize('update', $inquiry);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,read,responded'],
        ]);

        $inquiry->update($validated);

        return response()->json([
            'result' => true,
            'mje' => 'Consulta actualizada correctamente',
            'data' => $inquiry,
        ]);
    }

    public function destroy(Inquiry $inquiry): JsonResponse
    {
        $this->authorize('delete', $inquiry);

        $inquiry->delete();

        return response()->json([
            'result' => true,
            'mje' => 'Consulta eliminada correctamente',
        ]);
    }
}
