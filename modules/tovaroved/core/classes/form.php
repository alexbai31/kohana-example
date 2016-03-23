<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 15.10.12
 * Time: 0:16
 * To change this template use File | Settings | File Templates.
 */

class Form extends Kohana_Form
{
    public static function input($name, $value = NULL, array $attributes = NULL)
    {
        // Set the input name
        if (!is_null($name))
            $attributes['name'] = $name;

        // Set the input value
        if (!is_null($value))
            $attributes['value'] = $value;

        if (!isset($attributes['type'])) {
            // Default type is text
            $attributes['type'] = 'text';
        }

        return '<input' . HTML::attributes($attributes) . ' />';
    }

    public static function option($content = "", $value = NULL, array $attributes = NULL)
    {
        if(!is_null($value))
            $attributes["value"] = $value;
        
        return '<option ' . HTML::attributes($attributes) . '>' . $content . '</option>';

    }
}
