<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Schema;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campos = Schema::getColumnListing("proyectos");
        $exclude=["created_at","updated_at"];
        $campos= array_diff($campos,$exclude);
        $filas = Proyecto::select($campos)->get();

       return view('proyectos.index', compact('filas',"campos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proyectos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProyectoRequest $request)
    {
        $datos = request()->input();
        $proyecto = new Proyecto($datos);
        $proyecto->save();
        session()->flash('mensaje','Proyecto creado');
        return redirect()->route('proyectos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        return view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto)
    {
        $datos = request()->input();
        $proyecto->update($datos);
        session()->flash('mensaje','Proyecto actualizado');
        return redirect()->route('proyectos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        session()->flash('mensaje','Proyecto eliminado');
        return redirect()->route('proyectos.index');
    }
}
