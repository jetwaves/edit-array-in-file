<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;

$editor = new Editor('../testSource/Kernel.php');

echo ' ============================================================================================='.PHP_EOL;
echo ' =======================  Test case 3   delete item of array in variable ======================'.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

// 1.4. CRUD->D : delete one line in target Key-Value pair
$editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)
    ->find('auth', Editor::FIND_TYPE_ALL);

echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   Before deleting one line '.PHP_EOL;
$editor->echoTargetArea();

$editor->delete()->save()->flush();

echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   After deleting one line '.PHP_EOL;
$editor->echoTargetArea();


$return = PHP_EOL.
'WARNING: THIS FUNCTION [ echoTargetArea() ] SHOULD ONLY BE USED DURING TEST 
     Jetwaves\EditArrayInFile\Editor::echoTargetArea() line:121   $this->_editArea             = Array
(
    [0] =>     protected $routeMiddleware = [
            // <=======   here, The line "auth" has been deleted
    [1] =>         \'auth.basic\' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

    [2] =>         \'bindings\' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

    [3] =>         \'can\' => \Illuminate\Auth\Middleware\Authorize::class,

    [4] =>         \'guest\' => \App\Http\Middleware\RedirectIfAuthenticated::class,

    [5] =>         \'throttle\' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    [6] =>         \'jwt.auth\' => \App\Http\Middleware\VerifyJWTToken::class

    [7] =>     ];

)


';

echo PHP_EOL.' ===== TEST Result : should return =========  '.PHP_EOL.$return;
