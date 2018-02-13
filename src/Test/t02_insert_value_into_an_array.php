<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;


//###When the target is an array in the value of a Key-Value pair)
// ======= exemple of insert one line into [aliases] array in file [app.php]
$editor = new Editor('../testSource/app.php');


// 1.2. CRUD->C : Insert into target Key-Value pair in a php source code file:
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   1.2. CRUD->C : Insert into target Key-Value pair in a php source code file: '.PHP_EOL;
$editor->where('aliases',[], Editor::TYPE_KV_PAIR);
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   ===== Before inserting value into array Aliases '.PHP_EOL;
$editor->echoParts();
$editor->insert("'JWTAuth007' => Tymon\\JWTAuth\\Facades\\JWTAuth008::class".PHP_EOL);
$editor->save();
echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   ===== After inserting value into array Aliases '.PHP_EOL;
$editor->echoParts();
$editor->save()->flush();



/*
 * Return:

Should return :

     Jetwaves\EditArrayInFile\Editor::echoParts() line:112   $this->_editArea             = Array
(
    [0] =>     'aliases' => [

    [1] =>         'App' => Illuminate\Support\Facades\App::class,

    [2] =>         'Artisan' => Illuminate\Support\Facades\Artisan::class,

    [3] =>         'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class,

    [4] =>         'JWTAuth007' => Tymon\JWTAuth\Facades\JWTAuth008::class      // This is the added line

    [5] =>     ],

)


 *
 *
 * */

$return = PHP_EOL.PHP_EOL.' =========== TEST RESULT:  should return the content of array aliases in app.php : ================
     Jetwaves\EditArrayInFile\Editor::echoParts() line:112   $this->_editArea             = Array
(
    [0] =>     \'aliases\' => [

    [1] =>         \'App\' => Illuminate\Support\Facades\App::class,

    [2] =>         \'Artisan\' => Illuminate\Support\Facades\Artisan::class,

    [3] =>         \'JWTAuth\' => Tymon\JWTAuth\Facades\JWTAuth::class,

    [4] =>         \'JWTAuth007\' => Tymon\JWTAuth\Facades\JWTAuth008::class      // This is the added line

    [5] =>     ],

)
';

echo $return;