<?php  defined('SYSPATH') or die('No direct script access.');

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * Description of sphinx
 *
 * @author roman
 */
class Search
{

    public static function factory($driver = "sphinx")
    {
        $classname = Inflector::camelize($driver);
        $classname = "Driver_" . $classname;
        return new $classname;
    }

}

?>
