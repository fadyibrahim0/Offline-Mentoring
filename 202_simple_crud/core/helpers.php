<?php

/**
 * Die and Dump For Debug
 *
 * @param mixed $data
 * @return void
 */
function dd($data){
    echo "<pre>".print_r($data)."</pre>";
    exit;
}