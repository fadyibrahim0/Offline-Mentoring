<?php

session_start();

/**
 * Declare A Session With Specified Value
 *
 * @param String $name
 * @param Mixed $val
 * @return void
 */
function setSession($name, $val){
    $_SESSION[$name] = $val;
    return true;
}

/**
 * Return Value Of A Session
 *
 * @param String $name
 * @return Mixed
 */
function getSession($name){

    if(isset($_SESSION[$name])) {
        return $_SESSION[$name];
    }
    return false;
}

/**
 * Delete A Specified Session
 *
 * @param String $name
 * @return bool
 */
function deleteSession($name){
    if(isset($_SESSION[$name])) {
        unset($_SESSION[$name]);
        return true;
    }
    return false;
}

/**
 * Check If A Specified Session Is Exist Or Not
 *
 * @param String $name
 * @return bool
 */
function existSession($name){
    return isset($_SESSION[$name]);
}

/**
 * Return A Value Of Specified Session Then Delete This Session
 *
 * @param String $name
 * @return Mixed
 */
function flashSession($name){
    $temp = null;
    if(existSession($name)){
        $temp = getSession($name);
        deleteSession($name);
    } else {
        $temp = false;
    }
    return $temp;
}