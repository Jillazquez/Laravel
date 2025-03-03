<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProyectoResource;
use App\Http\Resources\ProyectoCollection;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoApiController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::all();
        return new ProyectoCollection($proyectos);
    }

    public function show($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        return new ProyectoResource($proyecto);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'horas_previstas' => 'required|integer',
            'fecha_comienzo' => 'required|date',
        ]);

        $proyecto = Proyecto::create($validated);
        return new ProyectoResource($proyecto);
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'horas_previstas' => 'required|integer',
            'fecha_comienzo' => 'required|date',
        ]);

        $proyecto->update($validated);
        return new ProyectoResource($proyecto);
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return response()->json(null, 204);
    }
}
