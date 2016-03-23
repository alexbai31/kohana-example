<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 20.09.12
 * Time: 0:05
 * To change this template use File | Settings | File Templates.
 */
class Driver_Yandex
{
    public function render($user_scripts = array(), $variables = array())
    {
        $config = Kohana::$config->load("map.yandex");
        $data["path_to_core"] = $config["path_to_core"];
        $view_folder = $config["view_folder"];
        $data["scripts"] = array();
        foreach ($user_scripts as $script) {
            $data["scripts"][] = $script;
        }
        foreach ($variables as $name => $value) {
            $data["vars"][$name] = $value;
        }

        return View::factory("$view_folder/map", $data)->render();
    }
}
