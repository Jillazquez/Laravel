
# Proyecto de Laravel

## Requisitos previos

Primero, asegúrate de tener instalado PHP y Composer en el ordenador:
```
php -v
composer --version
```
La respuesta debería ser algo así:
```
PHP 8.3.15 (cli) (built: Dec 17 2024 19:12:24) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.3.15, Copyright (c) Zend Technologies
Composer version 2.8.4 2024-12-11 11:57:47
```

## Creación del proyecto

Después, creamos un proyecto de Laravel eligiendo MySQL como base de datos y Blade para las plantillas:
```
composer create-project --prefer-dist laravel/laravel nombre_del_proyecto
```

Usamos un contenedor de Docker para arrancar la base de datos:
[DockerCompose](docker-compose.yaml)
```
docker compose up -d
```

## Configuración inicial

Creamos el `index` para poder trabajar con la parte registrada y la parte sin registrar: [Index](/resources/views/welcome.blade.php)
```
php artisan make:controller IndexController
```

Creamos un modelo:
```
php artisan make:model Proyectos
```

Modificamos las migraciones para crear la tabla:
```
php artisan make:migration create_nombre_de_la_tabla_table
```

Creamos las páginas `create.blade.php` y `index.blade.php` para poder trabajar con el modelo:
[Proyecto Crear](/resources/views/proyectos/create.blade.php)
[Proyecto Index](/resources/views/proyectos/index.blade.php)

Después, creamos en la página principal una card que nos redirija al index del modelo.

## Gestión de los idiomas

Primero instalamos las dependencias usando Composer:
```
composer require laravel-lang/lang
```

<details>
    <summary>Si tienes Linux</summary>

    ```bash
    apt install php-bcmath
    ```
</details>

Instalamos el lang:
```
php artisan lang:publish
```

Y después añadimos lenguajes:

<details>
    <summary>Español</summary>

    ```bash
    php artisan lang:add es
    ```
</details>

<details>
    <summary>Francés</summary>

    ```bash
    php artisan lang:add fr
    ```
</details>

Creamos el componente para los idiomas [Idiomas](/resources/views/components/layouts/lang.blade.php) y asignamos las rutas.

## Modelos y Relaciones

### Modelo `Profesor`

Creamos el modelo `Profesor` que representa a los profesores, junto con la migración correspondiente:
```
php artisan make:model Profesor -m
```

La migración debe contener la estructura de la tabla `profesors` (nombre, email, etc.). Asegúrate de añadir el campo `email` si lo necesitas.

### Modelo `Proyecto`

Creamos el modelo `Proyecto`, que tiene una relación muchos a muchos con los `Profesor`es. Añadimos la relación en el modelo `Proyecto`:
```php
public function profesores()
{
    return $this->belongsToMany(Profesor::class);
}
```

Y en el modelo `Profesor`, la relación inversa:
```php
public function proyectos()
{
    return $this->belongsToMany(Proyecto::class);
}
```

### Migración para la tabla pivote `profesor_proyecto`

Creamos una migración para la tabla pivote que almacena la relación entre `proyectos` y `profesors`:
```
php artisan make:migration create_profesor_proyecto_table --create=profesor_proyecto
```

La migración debe verse de la siguiente manera:
```php
Schema::create('profesor_proyecto', function (Blueprint $table) {
    $table->id();
    $table->foreignId('proyecto_id')->constrained()->onDelete('cascade');
    $table->foreignId('profesor_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

### Seeder para Profesores

Creamos un seeder para poblar la tabla `profesors` con algunos datos de ejemplo:
```
php artisan make:seeder ProfesorSeeder
```

En el archivo `ProfesorSeeder.php` podemos agregar algo así:
```php
public function run()
{
    \App\Models\Profesor::create([
        'nombre' => 'Juan Pérez',
        'email' => 'juan@dominio.com'
    ]);

    \App\Models\Profesor::create([
        'nombre' => 'Ana Gómez',
        'email' => 'ana@dominio.com'
    ]);
}
```

### Seeder para Proyectos

Creamos un seeder para poblar la tabla `proyectos` con algunos proyectos de ejemplo y asignarles profesores:
```
php artisan make:seeder ProyectoSeeder
```

### Actualización de Proyectos

El método `update` en el controlador de `Proyecto` se actualiza para manejar la relación con los profesores. Ahora permite sincronizar los profesores seleccionados en el formulario:
```php
public function update(UpdateProyectoRequest $request, Proyecto $proyecto)
{
    $datos = $request->all(); 
    $proyecto->update($datos); 

    if ($request->has('profesores')) {
        $proyecto->profesores()->sync($request->profesores); 
    }

    session()->flash('mensaje', 'Proyecto actualizado');
    return redirect()->route('proyectos.index');
}
```

### Formulario de Edición

En la vista `edit.blade.php`, añadimos un campo de selección múltiple para los profesores, que permite seleccionar varios profesores para asignarlos al proyecto:
```html
<div class="mb-4">
    <x-input-label for="profesores" value="Profesores" />
    <select id="profesores" name="profesores[]" multiple class="form-control">
        @foreach($profesores as $profesor)
            <option value="{{ $profesor->id }}" 
                    @if(in_array($profesor->id, $proyecto->profesores->pluck('id')->toArray())) 
                        selected 
                    @endif>
                {{ $profesor->nombre }}
            </option>
        @endforeach
    </select>
</div>
```

## Comandos útiles

1. **Ejecutar migraciones**:
```
php artisan migrate
```

2. **Ejecutar seeders**:
```
php artisan db:seed --class=ProfesorSeeder
php artisan db:seed --class=ProyectoSeeder
```

3. **Ejecutar el servidor local**:
```
php artisan serve
```

4. **Ejecutar node para estilos**:
```
npm run dev
```

5. **Reiniciar base de datos para ejecutar seeders**:
```
php artisan migrate:fresh --seed
```
---