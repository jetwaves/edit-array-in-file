<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;

$editor = new Editor('../testSource/app.php');

// 1.3. CRUD->R : Search in target Key-Value pair for a key :
$val = $editor->where('aliases',[], Editor::TYPE_KV_PAIR)
    ->find('App', Editor::FIND_TYPE_KEY_ONLY);
echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true).PHP_EOL;


// 1.3  case 2
$val = $editor->where('providers',[], Editor::TYPE_KV_PAIR)
    ->find('Illuminate\Bus\BusServiceProvider::class', Editor::FIND_TYPE_ALL);
echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true).PHP_EOL;


$return = '
     () line:13   target key `s val  = Illuminate\Support\Facades\App::class
     () line:19   target key `s val  = Illuminate\Bus\BusServiceProvider::class
';

echo PHP_EOL.'  ===== TEST RESULT: should return ========'.PHP_EOL;
echo $return;