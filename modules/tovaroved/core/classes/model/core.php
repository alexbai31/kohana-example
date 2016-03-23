<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Core extends Jelly_Model {

    protected static $_defaults = array(
        "table" => "",
        "primary_key" => "id",
        "relations" => array()
    );

    public static function initialize(Jelly_Meta $meta) {
        $vars = get_class_vars(get_called_class());
        $settings = isset($vars['_settings']) && !empty($vars['_settings']) ? array_merge(self::$_defaults, $vars["_settings"]) : self::$_defaults;


        if (empty($settings['table']))
            $settings['table'] = strtolower(substr(get_called_class(), 6));
        $meta->table($settings['table']);
        $fields = Database::instance()->list_columns($settings['table']);
        foreach ($fields as $name => $info) {
            if (!array_key_exists(str_replace("_id", "", $name), $settings["relations"])) {
                if ($name != $settings['primary_key']) {
                    $type = "Field_" . ucfirst(strtolower(str_replace(" ", "", $info['original_type'])));
                } else {
                    $type = "Field_Primary";
                }
                $meta->fields(array($name => new $type));
            }
        }
        foreach ($settings['relations'] as $field => $relation) {
            $type = "Field_" . Inflector::camelize(Inflector::humanize($relation["type"]));
            $meta->fields(array($field => new $type($relation["data"])));
        }
    }
}

?>
