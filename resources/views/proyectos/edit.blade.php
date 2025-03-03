<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">

            <form action="{{ route('proyectos.update', $proyecto->id) }}" method="post">
                @method('PUT')
                @csrf

                <!-- Título del Proyecto -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="titulo" value="Título" />
                        <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo" value="{{ $proyecto->titulo }}" required />
                    </div>

                    <!-- Horas previstas -->
                    <div>
                        <x-input-label for="horas_previstas" value="Horas previstas" />
                        <x-text-input id="horas_previstas" class="block mt-1 w-full" type="number" name="horas_previstas" value="{{ $proyecto->horas_previstas }}" required />
                    </div>

                    <!-- Fecha de comienzo -->
                    <div>
                        <x-input-label for="fecha_comienzo" value="Fecha de comienzo" />
                        <x-text-input id="fecha_comienzo" class="block mt-1 w-full" type="date" name="fecha_comienzo" value="{{ $proyecto->fecha_comienzo }}" required />
                    </div>
                </div>

                <!-- Selección de Profesores -->
                <div class="mt-4">
                    <x-input-label for="profesores" value="Asignar Profesores" />
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        @foreach($profesores as $profesor)
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       name="profesores[]" 
                                       value="{{ $profesor->id }}"
                                       @if(in_array($profesor->id, $profesoresSeleccionados)) checked @endif>
                                <span class="ml-2">{{ $profesor->nombre }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Botones de Guardar/Cancelar -->
                <div class="flex flex-row justify-between p-3 mt-4">
                    <button class="btn btn-warning" type="submit">Guardar</button>
                    <a href="{{ route('proyectos.index') }}" class="btn btn-warning">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</x-layouts.layout>
