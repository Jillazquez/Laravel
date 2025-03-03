<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">

            <form action="{{route("proyectos.store")}}" method="post">
                @csrf
            <div>
                <x-input-label for="titulo" value="Titulo" />
                <x-text-input id="titulo" class="block mt-1 w-full" type="text" name="titulo"   />
            </div>
            <div>
                <x-input-label for="horas_previstas" value="Horas Previstas" />
                <x-text-input id="horas_previstas" class="block mt-1 w-full" type="number" name="horas_previstas" />
            </div>
            <div>
                <x-input-label for="fecha_comienzo" value="Fecha de Comienzo" />
                <x-text-input id="fecha_comienzo" class="block mt-1 w-full" type="date" name="fecha_comienzo" />
            </div>
            <div class="flex flex-row justify-between p-3">
                <button class="btn btn-warning" type="submit">Guardar</button>
                <button class="btn btn-warning" type="submit">Cancelar</button>

            </div>
            </form>


        </div>
    </div>
</x-layouts.layout>
