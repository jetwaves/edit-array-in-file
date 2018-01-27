<?php
namespace Jetwaves\EditArrayInFile;

require('EditArrayInFileEditor.php');

//###When the target is an array in the value of a Key-Value pair)
// ======= exemple of insert one line into [aliases] array in file [app.php]
//$editor = new Editor('testSource/app.php');

// 1.1. CRUD->R : Find target variable in a php source code file:
//    $targetArray = $editor->where('aliases',[], Editor::TYPE_KV_PAIR)->get();
//    echo '     '.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);


// 1.2. CRUD->C : Insert into target variable in a php source code file:
//    $editor->where('aliases',[], Editor::TYPE_KV_PAIR);
//    $editor->insert("'JWTAuth' => Tymon\\JWTAuth\\Facades\\JWTAuth::class".PHP_EOL);
//    $editor->save()->flush();

// 1.3. CRUD->R : Search in target variable for a key :
//    $val = $editor->where('aliases',[], Editor::TYPE_KV_PAIR)
//                    ->find('App', Editor::FIND_TYPE_KEY_ONLY);
//    echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);
//
//    // 1.3  case 2
//    $val = $editor->where('providers',[], Editor::TYPE_KV_PAIR)
//        ->find('Illuminate\Bus\BusServiceProvider::class', Editor::FIND_TYPE_ALL);
//    echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);

//###When the target is an array in a variable)
$editor = new Editor('testSource/Kernel.php');
// 2.1. CRUD->R : Find target variable in a php source code file:
//    $targetArray = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();
//    echo '     '.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);

// 2.2. CRUD->C : Insert into target key's value in a php source code file:
//    $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE);
//    $editor->insert("'jetwaves.auth' => \\App\\Ssq\\TestMiddleware\\VerifyJWTToken::class".PHP_EOL);
//    $editor->save()->flush();

// 2.3. CRUD->R : Search in target variable for a key :
$val = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)
    ->find('bindings', Editor::FIND_TYPE_KEY_ONLY);
echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);

return;
// 2.3  case 2
$val = $editor->where('providers',[], Editor::TYPE_KV_PAIR)
    ->find('Illuminate\Bus\BusServiceProvider::class', Editor::FIND_TYPE_ALL);
echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true);


