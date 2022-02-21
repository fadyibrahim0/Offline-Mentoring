<?php

/**
 * Returns Valid String To Be Stored In Database
 *
 * @param String $val
 * @return string
 */
function validString($val){
    return trim(htmlspecialchars($val));
}


/**
 * Check If The Sent Value Less Than Expected Number Or Not
 *
 * @param String $val
 * @param Integer $num
 * @return bool
 */
function minVal($val, $num){
    if(strlen($val) < $num) {
        return true;
    } else {
        return false;
    }
}


/**
 * Check If The Sent Value More Than Expected Number Or Not
 *
 * @param String $val
 * @param Integer $num
 * @return bool
 */
function maxVal($val, $num){
    if(strlen($val) > $num) {
        return true;
    } else {
        return false;
    }
}