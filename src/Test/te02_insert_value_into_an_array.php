<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;


//###When the target is an array in the value of a variable like  $varName
$editor = new Editor('../testSource/Kernel.php');


// 2.2. CRUD->C : Insert into target Key-Value pair of Variable  in a php source code file:
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   2.2. CRUD->C : Insert into target Key-Value pair in a php source code file: '.PHP_EOL;
$editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE);
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor->getEditArea() BEFORE  = '.print_r($editor->getEditArea(), true);;
$editor->insert("'jetwaves.auth' => \\App\\Ssq\\TestMiddleware\\VerifyJWTToken::class".PHP_EOL, Editor::INSERT_TYPE_ARRAY);
$editor->save();
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   ===== After inserting value into array Aliases '.PHP_EOL;
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor->getEditArea() AFTER  = '.print_r($editor->getEditArea(), true);;
$editor->save()->flush();



$return = PHP_EOL.PHP_EOL.' =========== TEST RESULT:  should return the content of array aliases in app.php : ================
/home/jetwaves/dev/__github/edit-array-in-file/src/Test/te02_insert_value_into_an_array.php->() line:19   ===== After inserting value into array Aliases 
/home/jetwaves/dev/__github/edit-array-in-file/src/Test/te02_insert_value_into_an_array.php->() line:20   $editor->getEditArea() AFTER  = Array
(
    [0] =>     protected $routeMiddleware = [

    [1] =>         \'auth\' => \Illuminate\Auth\Middleware\Authenticate::class,

    [2] =>         \'auth.basic\' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

    [3] =>         \'bindings\' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

    [4] =>         \'can\' => \Illuminate\Auth\Middleware\Authorize::class,

    [5] =>         \'guest\' => \App\Http\Middleware\RedirectIfAuthenticated::class,

    [6] =>         \'throttle\' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    [7] =>         \'jwt.auth\' => \App\Http\Middleware\VerifyJWTToken::class,

    [8] =>         \'jetwaves.auth\' => \App\Ssq\TestMiddleware\VerifyJWTToken::class       // <=== this is the added line

    [9] =>     ];

)

';

echo $return;