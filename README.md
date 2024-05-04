<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Guía
## Requerimientos
### PHP
Laravel 10.x requiere una versión mínima de PHP de 8.1.
### Composer
Composer es una herramienta para la gestión de dependencias en PHP. Le permite declarar las bibliotecas de las que depende su proyecto y las administrará (instalará/actualizará) por usted.
- [Sitio Web](https://getcomposer.org/)
- [Documentación](https://getcomposer.org/doc/)
- [Descargas e Instalación](https://getcomposer.org/download/)
## Instalación
Después de haber instalado PHP y Composer, puede crear un nuevo proyecto de Laravel a través del comando create-project de Composer:
~~~
composer create-project laravel/laravel example-app
~~~
## Estructura de carpetas

### VISTAS
Blade es el motor de plantillas simple pero potente que se incluye con Laravel. A diferencia de algunos motores de plantillas PHP, Blade no le impide usar código PHP simple en sus plantillas. De hecho, todas las plantillas de Blade se compilan en código PHP simple y se almacenan en caché hasta que se modifican, lo que significa que Blade prácticamente no agrega gastos generales a su aplicación. Los archivos de plantilla Blade usan la extensión de archivo .blade.php y generalmente se almacenan en el directorio de **recursos/vistas**.
- [Documentación](https://laravel.com/docs/10.x/views)
### RUTAS
El directorio de rutas contiene todas las definiciones de ruta para su aplicación. De forma predeterminada, se incluyen varios archivos de ruta con Laravel: web.php, api.php, console.php ychannels.php.

El archivo web.php contiene rutas que RouteServiceProvider coloca en el grupo de middleware web, que proporciona estado de sesión, protección CSRF y cifrado de cookies. Si su aplicación no ofrece una API RESTful sin estado, lo más probable es que todas sus rutas se definan en el archivo web.php.
- [Documentación](https://laravel.com/docs/10.x/structure#the-routes-directory)

## Base de Datos
### ELOQUENT
Laravel incluye Eloquent, un mapeador relacional de objetos (ORM) que hace que sea agradable interactuar con su base de datos. Al usar Eloquent, cada tabla de la base de datos tiene un "Modelo" correspondiente que se usa para interactuar con esa tabla. Además de recuperar registros de la tabla de la base de datos, los modelos Eloquent también le permiten insertar, actualizar y eliminar registros de la tabla.
- [Documentación](https://laravel.com/docs/10.x/eloquent#introduction)
### MODELOS
Para comenzar, creemos un modelo Eloquent. Los modelos generalmente viven en el directorio app\Models y extienden la clase Illuminate\Database\Eloquent\Model. Puede usar el comando de Artisan `make:model` para generar un nuevo modelo:
~~~
php artisan make:model Task
~~~
Si desea generar una migración de base de datos cuando genera el modelo, puede usar la opción --migration o -m:
~~~
php artisan make:model Task -m
~~~
### CONEXIÓN
- CREAR un nueva base de datos y CONFIGURAR las variables de entorno  en el archivo `.env` para establecer la conexión.
- Verificar el *estado* de las migraciones: `php artisan migrate:status`
- Correr las migraciones: `php artisan:migrate`
- En el caso de ser necesario se puede dar 'marcha atrás' con el comando: `php artisan:migrate:rollback`

## Controladores
En lugar de definir toda su lógica de manejo de solicitudes como cierres en sus archivos de ruta, es posible que desee organizar este comportamiento utilizando clases de "controlador". Los controladores pueden agrupar la lógica de manejo de solicitudes relacionadas en una sola clase. Por ejemplo, una clase UserController podría manejar todas las solicitudes entrantes relacionadas con los usuarios, incluida la visualización, creación, actualización y eliminación de usuarios. De forma predeterminada, los controladores se almacenan en el directorio `app/Http/Controllers.`

Para generar rápidamente un nuevo controlador, puede ejecutar el comando make:controller Artisan. De forma predeterminada, todos los controladores de su aplicación se almacenan en el directorio `app/Http/Controllers:`
~~~
php artisan make:controller TaskController
~~~
- Una vez creado el controlador, se utilizan las siguientes convenciones para crear los métodos del mismo
    ~~~
    index   listar todos
    store   guardar un nuevo registro
    edit    mostrar el formulario de edición
    update  actualizar un registro existente
    destroy eliminar un registro
    ~~~
### STORE
~~~
    public function store(Request $request){

    }
~~~
- `$request` es de tipo **Request**, es decir hace referencia a la petición que llega a este método.
~~~
    public function store(Request $request){

        $request->validate([
            'title' => 'required | min: 3',
            'description' => 'required | min : 20'
        ]);
    }
~~~
- De esta manera podemos utilizar el método `validate()` para validar la información que llegua en la petición HTTP.
~~~
    public function store(Request $request){

         $request->validate([
            'title' => 'required | min: 3',
            'description' => 'required | min : 20'
        ]);

        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;

        $course->save();
    }
~~~
- Haciendo referencia al modelo con `use App\Models\Course;` se crea una instancia del mismo para luego almacenar la información.
~~~
    public function store(Request $request){

         $request->validate([
            'title' => 'required | min: 3',
            'description' => 'required | min : 20'
        ]);

        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;

        $course->save();

        return redirect()->route('courses')->with('success' , 'Curso agregado correctamente');

    }
~~~
- Luego se redirije a la ruta que corresponda, agregando un mensaje satisfactorio
- CREAR la nueva ruta por POST que lleve al método recién creado:
~~~
use App\Http\Controllers\CourseController;

Route::post('/courses',[CourseController::class, 'store'])->name('courses);
~~~
- MODIFICAR el formulario haciendo referencia al 'nombre' de la ruta
~~~
<form action="{{route('courses')}}" method="POST" enctype="multipart/form-data">
~~~
### CSRF
Las falsificaciones de solicitudes entre sitios son un tipo de explotación maliciosa mediante la cual se ejecutan comandos no autorizados en nombre de un usuario autenticado. Afortunadamente, Laravel facilita la protección de su aplicación contra los ataques de falsificación de solicitudes entre sitios (CSRF).
- Agregar dentro del formulario la directiva @csrf
## Resource
`php artisan make:migrate NombreControlador --resource`