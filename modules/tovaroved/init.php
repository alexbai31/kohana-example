<?php
$modules = scandir(__DIR__);
array_shift($modules);
array_shift($modules);
foreach ($modules as $module) {
    if (!preg_match("/^.*\.php$/", $module)) {
        Kohana::modules(Kohana::modules() + array(
            $module => MODPATH . 'tovaroved/' . $module
        ));

    }
}
