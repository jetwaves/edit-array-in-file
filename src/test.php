<?php
namespace Jetwaves\EditArrayInFile;

require('EditArrayInFileEditor.php');


//// ==== kv pair type ======
//$editor = new Editor('testSource/app.php');
////$editor->where('providers',[], Editor::TYPE_KV_PAIR)->find();
//$editor->where('aliases',[], Editor::TYPE_KV_PAIR)->get();
//return;




// ==== variable array type ======
$editor = new Editor('testSource/Kernel.php');
//$editor->where('providers',[], Editor::TYPE_KV_PAIR)->find();
//$editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();

$obj = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE);
$obj->insert("    'jetwaves.auth' => \\App\\Ssq\\TestMiddleware\\VerifyJWTToken::class,".PHP_EOL);
//$obj->save();
echo print_r($obj->getEditArea(), true);
$obj->save()->flush();