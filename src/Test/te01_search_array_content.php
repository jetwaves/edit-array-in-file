<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;


//###When the target is an array in the value of a Key-Value pair)
$editor = new Editor('../testSource/Kernel.php');

// 1.1. CRUD->R : Find target variable in a php source code file:

echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   2.1. CRUD->R : Find target variable "$routeMiddleware" in a php source code file: '.PHP_EOL;
$targetArray = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);



$return = PHP_EOL.PHP_EOL.' =========== TEST RESULT:  should return the content of array aliases in app.php : ================

/home/jetwaves/dev/__github/edit-array-in-file/src/Test/te01_search_array_content.php->() line:17   $targetArray  = Array
(
    [0] =>     protected $routeMiddleware = [

    [1] =>         \'auth\' => \Illuminate\Auth\Middleware\Authenticate::class,

    [2] =>         \'auth.basic\' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

    [3] =>         \'bindings\' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

    [4] =>         \'can\' => \Illuminate\Auth\Middleware\Authorize::class,

    [5] =>         \'guest\' => \App\Http\Middleware\RedirectIfAuthenticated::class,

    [6] =>         \'throttle\' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    [7] =>         \'jwt.auth\' => \App\Http\Middleware\VerifyJWTToken::class

    [8] =>     ];

)
';

echo $return;