<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 10.09.12
 * Time: 16:58
 * To change this template use File | Settings | File Templates.
 */
class Helper_STR {
    public static function fill($string, $adding_symbol, $needing_length){
        if(strlen($string) >= $needing_length){
            return $string;
        }
        for($i = $needing_length - strlen($string); $i < $needing_length; $i++){
            $string .= $adding_symbol;
        }

        return $string;

    }
}
