<?php

// Root URL (used when redirect or href)
$projPath   = "/group308/workshop/";
define("URL", "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $projPath );

// Full Path ( use when require or include files)
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