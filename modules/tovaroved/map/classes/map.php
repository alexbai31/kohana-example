<?php  defined('SYSPATH') or die('No direct script access.');

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * Description of map
 *
 * @author roman
 */
class Map
{
    public static function factory($driver)
    {
        $class = "Driver_" . ucfirst($driver);
        return new $class;
    }
}

?>
