<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 25.09.12
 * Time: 17:41
 * To change this template use File | Settings | File Templates.
 */
class Days extends Kohana_Date {

    private static $_days = array(
        "en" => array(
            "mon", "tue", "wed", "thu", "fri", "sat", "sun"
        ),
        "ru" => array(
            "пн", "вт", "ср", "чт", "пт", "сб", "вс"
        )
    );


    public static function get_days_of_week($lang = "en") {
        return self::$_days[$lang];
    }

    public static function translate_to($lang, $day) {
        $from = $lang == "en" ? "ru" : "en";
        return self::$_days[$lang][array_search($day, self::$_days[$from])];
    }

}
