<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;

$editor = new Editor('../testSource/Kernel.php');


echo ' ============================================================================================='.PHP_EOL;
echo ' =======================  Test case 2.3   find key of array in variable ======================'.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

// 2.3. CRUD->R : Search in target variable Key-Value pair for a key :
$val = $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)
    ->find('auth.basic', Editor::FIND_TYPE_KEY_ONLY);
echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true).PHP_EOL;

echo PHP_EOL.PHP_EOL.' ==== Test Result:  should return ======'.PHP_EOL.
    '     () line:18   target key `s val  = \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class';



echo PHP_EOL.PHP_EOL.' ============================================================================================='.PHP_EOL;
echo ' ===================  Test case 2.3.2  find key array of array in variable ==================='.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

// 2.3  case 2
$editor->where('$middlewareGroups',[], Editor::TYPE_VARIABLE);
$val =$editor->find('web', Editor::FIND_TYPE_ALL);


//$editor->insert('testContent', Editor::INSERT_TYPE_AFTER);
//echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor->getEditArea()  = '.print_r($editor->getEditArea(), true);

echo '     '.__method__.'() line:'.__line__.'   target key `s val  = '.print_r($val, true).PHP_EOL;

$return = '
    () line:37   target key `s val  = [
';

echo PHP_EOL.'  ===== TEST RESULT: should return ========'.PHP_EOL;
echo $return;