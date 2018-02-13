<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;

$editor = new Editor('../testSource/app.php');

// 1.4. CRUD->D : delete one line in target Key-Value pair
$editor->where('aliases',[], Editor::TYPE_KV_PAIR)
    ->find('JWTAuth', Editor::FIND_TYPE_ALL);

echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   Before deleting one line '.PHP_EOL;
$editor->echoTargetArea();

$editor->delete()->save()->flush();

echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   After deleting one line '.PHP_EOL;
$editor->echoTargetArea();


$return = '
  WARNING: THIS FUNCTION [ echoTargetArea() ] SHOULD ONLY BE USED DURING TEST 
     Jetwaves\EditArrayInFile\Editor::echoTargetArea() line:118   $this->_editArea             = Array
(
    [0] =>     \'aliases\' => [

    [1] =>         \'App\' => Illuminate\Support\Facades\App::class,

    [2] =>         \'Artisan\' => Illuminate\Support\Facades\Artisan::class,

    [3] =>     ],

)

';

echo PHP_EOL.' ===== TEST Result : should return =========  '.PHP_EOL.
'    WARNING: THIS FUNCTION [ echoTargetArea() ] SHOULD ONLY BE USED DURING TEST 
     Jetwaves\EditArrayInFile\Editor::echoTargetArea() line:118   $this->_editArea             = Array
(
    [0] =>     \'aliases\' => [

    [1] =>         \'App\' => Illuminate\Support\Facades\App::class,

    [2] =>         \'Artisan\' => Illuminate\Support\Facades\Artisan::class,

            // <=======   here, The line "JWTAuth" has been deleted 

    [3] =>     ],

)
';