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

## Creacion del proyecto
Después, creamos un proyecto de Laravel elegimos mysql como bae de datos y blade para las plantillas:
```
composer create-project --prefer-dist laravel/laravel nombre_del_proyecto
```
Usamos un contenedor de docker para arrancar la base de datos
[DockerCompose](docker-compose.yaml)
```
docker compose up -d
```


Creamos el index para poder trabajar la parte registrada y la parte sin registrar: [Index](/resources/views/welcome.blade.php)
```
php artisan make:controller IndexController
```

Creamos un modelo:
```
php artisan make:model NombreDelModelo
```

Modificamos las migraciones para crear la tabla:
```
php artisan make:migration create_nombre_de_la_tabla_table
```

Creamos las paginas create.blade.php y index.blade.php para poder trabajar con el modelo<br>
[Proyecto Crear](/resources/views/proyectos/create.blade.php)
[Proyecto Index](/resources/views/proyectos/index.blade.php)<br>
Despues creamos en la pagina principal una card que nos rediriga al index del modelo

### Gestion de los idiomas

Primero instalamos las dependencias usando composer
```
composer require laravel-lang/lang
```
<details>
    <summary>Si tienes linux</summary>

    ```
    apt install php-bcmath
    ```

</details>

Instalamos el lang

php artisan lang:publish

Y despues añadimos lenguejes
<details>
    <summary>Español</summary>

    php artisan lang:add es
    

</details>
<details>
    <summary>Frances</summary>

    php artisan lang:add fr
    

</details>

Creamos el componente para los idiomas [Idiomas](/resources/views/components/layouts/lang.blade.php) y asignamos las rutas
