<?php

defined('SYSPATH') or die('No direct script access.');
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * Description of Secure
 *
 * @author roman
 */
class Helper_Secure
{

    private static $instance;

    public static function instance()
    {
        if (self::$instance === NULL)
            self::$instance = new Secure();

        return self::$instance;
    }

    public function crypt($string)
    {
        return Encrypt::instance()->encode($string);
    }

    public function decrypt($string)
    {
        return Encrypt::instance()->decode($string);
    }

}

?>
