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



//###When the target is an array in a variable)
//$editor = new Editor('testSource/Kernel.php');
// 2.1. CRUD->R : Find target variable in a php source code file:
//    $targetArray = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();
//    echo '     '.__method__.'() line:'.__line__.'   $targetArray  = '.print_r($targetArray, true);

//    $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE);
//    $editor->insert("'jetwaves.auth' => \\App\\Ssq\\TestMiddleware\\VerifyJWTToken::class".PHP_EOL);
//    $editor->save()->flush();




