# edit-array-in-file
CRUD (create/add/insert, modify/update, list/find/search, delete/remove) of elements from arrays in php file.


------
**CREDIT TO** [dingo/api](https://github.com/dingo/api) and [Laravel framework](https://github.com/laravel/laravel)

## Idea: use ORM-like code to manipulate file content
```php
<?php
$editor->where('aliases',[], Editor::TYPE_KV_PAIR)
       ->insert("'JWTAuth' => Tymon\\JWTAuth\\Facades\\JWTAuth::class".PHP_EOL)
       ->save()->flush();
```

## How to use:
## Installation:            (eg. in a Laravel 5+ project)
```shell
composer require jetwaves/edit-array-in-file
```

## API:
// TODO:


## Example:
### include the lib:
```php
<?php
    use Jetwaves\EditArrayInFile\Editor;
```
or
```php
<?php
    require('EditArrayInFileEditor.php');
```
### When the target is an array in the value of a Key-Value pair)
```php
<?php
    $editor = new Editor('testSource/app.php');
```
1.1.CRUD->R : Find target key in a php source code file:  
```php
<?php
    $targetArray = editor->where('aliases',[], Editor::TYPE_KV_PAIR)->get();
    echo '     '.method.'() line:'.line.'   targetArray  = '.print_r(targetArray, true);
```
the result is: 
```php
     () line:10   $targetArray  = Array
(
    [0] =>     'aliases' => [
// ATTENTION:  there is PHP_EOL in the end of these lines who are invisible.
    [1] =>

    [2] =>         'App' => Illuminate\Support\Facades\App::class,

    [3] =>         'Artisan' => Illuminate\Support\Facades\Artisan::class,

    [4] =>

    [5] =>     ],

)
```

1.2.CRUD->C : Insert into target key's value in a php source code file:   
```php
<?php
    $editor->where('aliases',[], Editor::TYPE_KV_PAIR);
    $editor->insert("'JWTAuth' => Tymon\\JWTAuth\\Facades\\JWTAuth::class".PHP_EOL);
    $editor->save()->flush();
```
the result is : (content of file app.php)
```php
<?php
return [
    'log' => env('APP_LOG', 'single'),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
    'providers' => [
        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
    ],
    'aliases' => [
        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class     // <====== HERE IS THE INSERTED LINE
    ],
];
```

###When the target is an array in a variable)
```php
<?php
    $editor = new Editor('testSource/Kernel.php');
```

2.1.CRUD->R : Find target variable in a php source code file:
```php
<?php
    $targetArray = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();
    echo '     '.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);
```
the result is: 
```php
     () line:26   $targetArray  = Array
(
    [0] =>     protected $routeMiddleware = [
// ATTENTION:  there is PHP_EOL in the end of these lines who are invisible.
    [1] =>         'auth' => \Illuminate\Auth\Middleware\Authenticate::class,

    [2] =>         'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

    [3] =>         'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

    [4] =>         'can' => \Illuminate\Auth\Middleware\Authorize::class,

    [5] =>         'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

    [6] =>         'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    [7] =>         'jwt.auth' => \App\Http\Middleware\VerifyJWTToken::class

    [8] =>     ];

)
```

2.2.CRUD->C : Insert into target key's value in a php source code file:   
```php
<?php
    $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE);
    $editor->insert("'jetwaves.auth' => \\App\\Ssq\\TestMiddleware\\VerifyJWTToken::class".PHP_EOL);
    $editor->save()->flush();
```
the result is : (content of file Kernel.php)
```php
<?php
namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel
{
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     * These middleware may be assigned to groups or used individually.
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'jwt.auth' => \App\Http\Middleware\VerifyJWTToken::class,
        'jetwaves.auth' => \App\Ssq\TestMiddleware\VerifyJWTToken::class  // <====== HERE IS THE INSERTED LINE
    ];
}

```






  