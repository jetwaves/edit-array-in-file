<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;

$editor = new Editor('../testSource/app.php');

// add one line before or after the anchor

echo ' ============================================================================================='.PHP_EOL;
echo ' ==============================    Test case 1 + 2 : Locate by array ========================='.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

        $editor->where('aliases',[], Editor::TYPE_KV_PAIR)
               ->find('JWTAuth', Editor::FIND_TYPE_ALL);

        echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   Target Area before Insertion '.PHP_EOL;
        $editor->echoTargetArea();
//        $editor->insert('just a little bit, be my little bit ...', $editor::INSERT_TYPE_BEFORE);
        $editor->insert('so what`s the problem, let`s do it quick', $editor::INSERT_TYPE_AFTER);

        $editor->find('JWTAuth', Editor::FIND_TYPE_ALL);
        $editor->insert('just a little bit, be my little bit ...', $editor::INSERT_TYPE_BEFORE);

        echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   Target Area after  Insertion '.PHP_EOL;
        $editor->echoTargetArea();

$return = PHP_EOL.PHP_EOL.' ====== TEST Result: should return =========='.PHP_EOL.
    '  WARNING: THIS FUNCTION [ echoTargetArea() ] SHOULD ONLY BE USED DURING TEST 
     Jetwaves\EditArrayInFile\Editor::echoTargetArea() line:119   $this->_editArea             = Array
(
    [0] =>     \'aliases\' => [

    [1] =>         \'App\' => Illuminate\Support\Facades\App::class,

    [2] =>         \'Artisan\' => Illuminate\Support\Facades\Artisan::class,

    [3] => just a little bit, be my little bit ...          //  <=====  line added with INSERT_TYPE_BEFORE option
    [4] =>         \'JWTAuth\' => Tymon\JWTAuth\Facades\JWTAuth::class      // <----  locate by keyword   aliases->JWTAuth

    [5] => so what`s the problem, let`s do it quick         //  <=====  line added with INSERT_TYPE_AFTER option
    [6] =>     ],

)
';

echo $return;

echo ' ============================================================================================='.PHP_EOL;
echo ' ==============================    Test case 3   Locate by Raw compare  ======================'.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

    $editor2 = new Editor('../testSource/app.php');
    $editor2->where('log_level', [], Editor::TYPE_RAW);
//    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor->get()  = '.print_r($editor->get(), true);
    
//    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor2->getParseRes()  = '.print_r($editor2->getParseRes(), true);
    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor2->getEditArea()  BEFORE  = '.print_r($editor2->getEditArea(), true);
    $editor2->insert('too gros, too klein ..', Editor::INSERT_TYPE_AFTER);
$editor2->insert('TOO BIG, TOO SMALL ..', Editor::INSERT_TYPE_BEFORE);
    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor2->getEditArea()  AFTER   = '.print_r($editor2->getEditArea(), true);



$return2 = PHP_EOL.PHP_EOL.' ===== TEST Result: should return ======'.PHP_EOL.
    '/home/jetwaves/dev/__github/edit-array-in-file/src/Test/t05_add_one_line_before-after_anchor.php->() line:66   $editor2->getEditArea()  BEFORE  = Array
(
    [0] =>     \'log_level\' => env(\'APP_LOG_LEVEL\', \'debug\'),

)
/home/jetwaves/dev/__github/edit-array-in-file/src/Test/t05_add_one_line_before-after_anchor.php->() line:69   $editor2->getEditArea()  AFTER   = Array
(
    [0] => TOO BIG, TOO SMALL ..                //  <=====  line added with INSERT_TYPE_BEFORE option
    [1] =>     \'log_level\' => env(\'APP_LOG_LEVEL\', \'debug\'),      //  <---- locate by keyword  log_level

    [2] => too gros, too klein ..               //  <=====  line added with INSERT_TYPE_AFTER option
)


';

echo $return2;
