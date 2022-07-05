<?php

class Errors
{
    public static function ErrorHandler($er_number, $er_string, $er_file, $er_line) {
        echo "<div style='background-color:red;padding:10px;margin: 5px;'>error message is : " . $er_string . "<br>";
        echo "at file : " . $er_file . "<br>";
        echo "in line : " . $er_line . "<br> </div>";
    }

    public static function ExceptionHandler(Throwable $e) {
        echo "<div style='background-color:orange;padding:10px;margin: 5px;'>error message is : " . $e->getMessage() . "<br>";
        echo "at file : " . $e->getFile() . "<br>";
        echo "in line : " . $e->getLine() . "<br> </div>";
    }
}