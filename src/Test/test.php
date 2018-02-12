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


// 1.2. CRUD->C : Insert into target Key-Value pair in a php source code file:
    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   1.2. CRUD->C : Insert into target Key-Value pair in a php source code file: '.PHP_EOL;
    $editor->where('aliases',[], Editor::TYPE_KV_PAIR);
    $editor->insert("'JWTAuth007' => Tymon\\JWTAuth\\Facades\\JWTAuth008::class".PHP_EOL);
    $editor->save()->flush();


    return;
// 1.3. CRUD->R : Search in target Key-Value pair for a key :
    $val = $editor->where('aliases',[], Editor::TYPE_KV_PAIR)
                    ->find('App', Editor::FIND_TYPE_KEY_ONLY);
    echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);

    // 1.3  case 2
    $val = $editor->where('providers',[], Editor::TYPE_KV_PAIR)
        ->find('Illuminate\Bus\BusServiceProvider::class', Editor::FIND_TYPE_ALL);
    echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);
// 1.4. CRUD->D : delete one line in target Key-Value pair
        $editor->where('aliases',[], Editor::TYPE_KV_PAIR)
               ->find('JWTAuth', Editor::FIND_TYPE_ALL);
        $editor->delete()->save()->flush();
// 1.5. CRUD->C : add one line after / before the anchor line



//###When the target is an array in a variable)
//$editor = new Editor('testSource/Kernel.php');
// 2.1. CRUD->R : Find target variable in a php source code file:
//    $targetArray = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();
//    echo '     '.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);

// 2.2. CRUD->C : Insert into target key's value in a php source code file:
//    $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE);
//    $editor->insert("'jetwaves.auth' => \\App\\Ssq\\TestMiddleware\\VerifyJWTToken::class".PHP_EOL);
//    $editor->save()->flush();

// 2.3. CRUD->R : Search in target variable for a key :
//    $val = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)
//        ->find('bindings', Editor::FIND_TYPE_KEY_ONLY);
//    echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);

// 2.3  case 2
//    $val = $editor->where('providers',[], Editor::TYPE_KV_PAIR)
//        ->find('Illuminate\Bus\BusServiceProvider::class', Editor::FIND_TYPE_ALL);
//    echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);

// 2.4. CRUD->D : delete one line in target variable
//    $val = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)
//        ->find('auth.basic', Editor::FIND_TYPE_ALL);
//    $editor->delete()->save()->flush();

