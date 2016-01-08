<?php


define ("U_CONTINUE",0x1);
define ("U_FIELD",0x2);

class information {
    private static $field;
    public static function get($index) {
        return ($index & self::$field);
    }

    public static function set($index) {
        self::$field = self::$field | $index;
    }
}



function information ($flag = 0) {

}