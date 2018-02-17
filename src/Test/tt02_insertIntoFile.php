<?php
namespace Jetwaves\EditArrayInFile\Test;


require('../EditArrayInFileEditor.php');
use Jetwaves\EditArrayInFile\Editor as Editor;


//###When the target is an array in the value of a Key-Value pair)
// ======= exemple of insert one line into [aliases] array in file [app.php]
//$editor = new Editor('../testSource/app.php');

try {
    $dataToInsert = "use Illuminate\Support\Facades\Schema;".PHP_EOL;
    Editor::insertIntoFile('../testSource/AppServiceProvider.php',
        "use Illuminate\Support\ServiceProvider;", 1, $dataToInsert);

    $dataToInsert = "        Schema::defaultStringLength(191);".PHP_EOL;
    Editor::insertIntoFile('../testSource/AppServiceProvider.php',
        "public function register()", 3, $dataToInsert);

} catch (\Exception $e) {
    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.PHP_EOL.'   $e->getMessage()  = '.print_r($e->getMessage(), true).PHP_EOL;
    echo ''.__FILE__.'->'.__method__.'() line:'.__line__.PHP_EOL.'   $e->trace  = '.print_r($e->getTraceAsString(), true).PHP_EOL;
}






