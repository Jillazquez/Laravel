
<x-layouts.layout>
    <div class="flex flex-row justify-center items-center min-h-full bg-gray-300">
        <div class="bg-white p-3 rounded-2xl">

            <div class="grid grid-cols-2">
            <div>
                <x-input-label for="nombre" value="Nombre" />
                <span class="block mt-1 w-full">{{$alumno->nombre}}</span>
            </div>
            <div>
                <x-input-label for="email" value="Email" />
                <span class="block mt-1 w-full">{{$alumno->email}}</span>
            </div>
            <div>
                <x-input-label for="edad" value="Edad" />
                <span class="block mt-1 w-full">{{$alumno->edad}}</span>
            </div>
            <div class="flex flex-row justify-between p-3 gap-3">
                <button class="btn btn-warning" type="submit">Guardar</button>
                <button class="btn btn-warning" type="submit">Cancelar</button>

            </div>
            <div>
                
                @if($alumno->idiomas->isNotEmpty())
                <table class="table table-xs table-pin-rows table-pin-cols">
                    <thead>
                        <tr>
                            <th>Idioma</th>
                            <th>Nivel</th>
                            <th>Título</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alumno->idiomas as $idioma)
                        <tr>
                            <td>{{$idioma->idioma}}</td>
                            <td>{{$idioma->nivel}}</td>
                            <td>{{$idioma->titulo}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
</div>


        </div>
    </div>
</x-layouts.layout>
