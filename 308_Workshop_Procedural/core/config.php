<?php

$rootDirName =  basename(dirname(__DIR__));

$explodes = explode("/", $_SERVER['REQUEST_URI']);

// start generating final path in this situation  = /eraasoft/groups/group308/workshop/
$projPath = "";
foreach($explodes as $item) {
    if($item == $rootDirName) {
        $projPath .= "$item/";
        break;
    } 
    $projPath .= "$item/";
}

/* Root URL (used when redirect or href) */
define("URL", "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $projPath );

/* Full Path ( use when require or include files) */
define("PATH", $_SERVER['DOCUMENT_ROOT'] . $projPath);



/**
 * Helper Functions
 */

/**
 * Used for Debug
 *
 * @param [mixed] $data
 * @return void
 */
function dd($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
}