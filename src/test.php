<?php
namespace Jetwaves\EditArrayInFile;

require('EditArrayInFileEditor.php');


// ==== kv pair type ======
$editor = new Editor('testSource/app.php');
//$editor->where('providers',[], Editor::TYPE_KV_PAIR)->find();
$editor->where('aliases',[], Editor::TYPE_KV_PAIR)->get();


return;
// ==== variable array type ======
$editor = new Editor('testSource/Kernel.php');
//$editor->where('providers',[], Editor::TYPE_KV_PAIR)->find();
$editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)->get();


