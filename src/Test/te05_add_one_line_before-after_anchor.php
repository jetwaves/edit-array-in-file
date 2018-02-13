<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;

$editor = new Editor('../testSource/Kernel.php');

// add one line before or after the anchor

echo ' ============================================================================================='.PHP_EOL;
echo ' ==============================    Test case 1 + 2 : Locate by array ========================='.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

        $editor->where('$routeMiddleware',[], Editor::TYPE_VARIABLE)
               ->find('auth', Editor::FIND_TYPE_ALL);

        echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   Target Area before Insertion '.PHP_EOL;
        $editor->echoTargetArea();
        $editor->insert('so what`s the problem, let`s do it quick'.PHP_EOL, $editor::INSERT_TYPE_AFTER);

        $editor->find('guest', Editor::FIND_TYPE_ALL);
        $editor->insert('just a little bit, be my little bit ...'.PHP_EOL, $editor::INSERT_TYPE_BEFORE);

        echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   Target Area after  Insertion '.PHP_EOL;
        $editor->echoTargetArea();
        $editor->save()->flush();

$return = PHP_EOL.PHP_EOL.' ====== TEST Result: should return =========='.PHP_EOL.
'  WARNING: THIS FUNCTION [ echoTargetArea() ] SHOULD ONLY BE USED DURING TEST 
     Jetwaves\EditArrayInFile\Editor::echoTargetArea() line:121   $this->_editArea             = Array
(
    [0] =>     protected $routeMiddleware = [

    [1] =>         \'auth\' => \Illuminate\Auth\Middleware\Authenticate::class,         // <----  locate by keyword   $routeMiddleware->auth

    [2] => so what`s the problem, let`s do it quick         //  <=====  line added with INSERT_TYPE_AFTER option
    [3] =>         \'auth.basic\' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

    [4] =>         \'bindings\' => \Illuminate\Routing\Middleware\SubstituteBindings::class,

    [5] =>         \'can\' => \Illuminate\Auth\Middleware\Authorize::class,

    [6] => just a little bit, be my little bit ...          //  <=====  line added with INSERT_TYPE_BEFORE option
    [7] =>         \'guest\' => \App\Http\Middleware\RedirectIfAuthenticated::class,    // <----  locate by keyword   $routeMiddleware->guest

    [8] =>         \'throttle\' => \Illuminate\Routing\Middleware\ThrottleRequests::class,

    [9] =>         \'jwt.auth\' => \App\Http\Middleware\VerifyJWTToken::class

    [10] =>     ];

)

';

echo $return;


echo ' ============================================================================================='.PHP_EOL;
echo ' ==============================    Test case 3   Locate by Raw compare  ======================'.PHP_EOL;
echo ' ============================================================================================='.PHP_EOL;

    $editor2 = new Editor('../testSource/Kernel.php');
    $editor2->where('Illuminate\Session\Middleware\StartSession', [], Editor::TYPE_RAW);
//    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor->get()  = '.print_r($editor->get(), true);
    
//    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor2->getParseRes()  = '.print_r($editor2->getParseRes(), true);
//    return;



    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor2->getEditArea()  BEFORE  = '.print_r($editor2->getEditArea(), true);
    $editor2->insert('too gros, too klein ..'.PHP_EOL, Editor::INSERT_TYPE_AFTER);
    $editor2->save();
    $editor2->insert('TOO BIG, TOO SMALL ..'.PHP_EOL, Editor::INSERT_TYPE_BEFORE);
    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.'   $editor2->getEditArea()  AFTER   = '.print_r($editor2->getEditArea(), true);


    $editor2->save()->flush();


$return2 = PHP_EOL.PHP_EOL.' ===== TEST Result: should return ======'.PHP_EOL.
'/home/jetwaves/dev/__github/edit-array-in-file/src/Test/te05_add_one_line_before-after_anchor.php->() line:74   $editor2->getEditArea()  BEFORE  = Array
(
    [0] =>             \Illuminate\Session\Middleware\StartSession::class,

)
/home/jetwaves/dev/__github/edit-array-in-file/src/Test/te05_add_one_line_before-after_anchor.php->() line:78   $editor2->getEditArea()  AFTER   = Array
(
    [0] => TOO BIG, TOO SMALL ..

    [1] =>             \Illuminate\Session\Middleware\StartSession::class,

    [2] => too gros, too klein ..

)


';

echo $return2;
