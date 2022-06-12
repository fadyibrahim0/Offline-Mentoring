<?php

/**
 * Redirect to a specific URL
 *
 * @param [string] $path
 * @return void
 */
function redirect($path) {

    header("Location:" . $path);
    die;
    exit;
}

/**
 * To Free The Database Returned Result, Then Close The Connection
 *
 * @param [mysqli_result] $result
 * @param [mysqli] $conn
 * @return void
 */
function free_close($result, $conn) {

    mysqli_free_result($result);
    mysqli_close($conn);
}