<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;


//###When the target is an array in the value of a Key-Value pair)
// ======= exemple of insert one line into [aliases] array in file [app.php]
$editor = new Editor('../testSource/app.php');


$data = 'Route::group([\'middleware\' => \'jwt.auth\'], function () {
    $api = app(\'Jetwaves\LaravelImplicitRouter\Router\');
    $api->controller(\'withauth\', \'App\Http\Controllers\JwtUserController\');
});

$api = app(\'Jetwaves\LaravelImplicitRouter\Router\');
$api->controller(\'noauth\', \'App\Http\Controllers\JwtUserController\');
';

$editor->append($data);


