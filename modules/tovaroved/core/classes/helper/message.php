<?php

defined('SYSPATH') or die('No direct script access.');

class Helper_Message
{

    private static $errors = array();
    private static $notices = array();

    public static function add_notice($message)
    {
        self::$notices = array_values(is_array($message) ? array_merge(self::$notices, $message) : array_merge(self::$notices, array($message)));
    }

    public static function add_error($message)
    {
        self::$errors = array_values(is_array($message) ? array_merge(self::$errors, $message) : array_merge(self::$errors, array($message)));
    }

    public static function get_errors()
    {
        return self::$errors;
    }

    public static function get_notices()
    {
        return self::$notices;
    }

    public static function get_last_error()
    {
        $result = array_reverse(self::$errors);
        if (!empty($result))
            $result = $result[0];
        else
            $result = "Error stack is empty";

        return $result;
    }

}

?>
