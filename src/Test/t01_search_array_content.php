<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;


//###When the target is an array in the value of a Key-Value pair)
// ======= exemple of insert one line into [aliases] array in file [app.php]
$editor = new Editor('../testSource/app.php');

// 1.1. CRUD->R : Find target variable in a php source code file:

echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   1.1. CRUD->R : Find target variable "aliases" in a php source code file: '.PHP_EOL;
$targetArray = $editor->where('aliases',[], Editor::TYPE_KV_PAIR)->get();
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);


/*
 *
 =========== should return:
/dev/edit-array-in-file/src/Test/t01_search_array_content.php->() line:15   1.1. CRUD->R : Find target variable "aliases" in a php source code file:
/dev/edit-array-in-file/src/Test/t01_search_array_content.php->() line:17   $targetArray  = Array
(
    [0] =>     'aliases' => [

    [1] =>         'App' => Illuminate\Support\Facades\App::class,

    [2] =>         'Artisan' => Illuminate\Support\Facades\Artisan::class,

    [3] =>         'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class

    [4] =>     ],

)

 *
 * */

$return = PHP_EOL.PHP_EOL.' =========== TEST RESULT:  should return the content of array aliases in app.php : ================

/dev/edit-array-in-file/src/Test/t01_search_array_content.php->() line:15   1.1. CRUD->R : Find target variable "aliases" in a php source code file:
/dev/edit-array-in-file/src/Test/t01_search_array_content.php->() line:17   $targetArray  = Array
(
    [0] =>     \'aliases\' => [

    [1] =>         \'App\' => Illuminate\Support\Facades\App::class,

    [2] =>         \'Artisan\' => Illuminate\Support\Facades\Artisan::class,

    [3] =>         \'JWTAuth\' => Tymon\JWTAuth\Facades\JWTAuth::class

    [4] =>     ],

)';

echo $return;