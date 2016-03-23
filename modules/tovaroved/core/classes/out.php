<?

defined('SYSPATH') or die('No direct script access.');

class OUT
{

    private static $current_page = NULL;
    private static $current_page_with_id = NULL;
    private static $options = NULL;

    private static function _init()
    {
        if (is_null(self::$current_page))
            self::$current_page = implode("_", array(
                Request::current()->controller(),
                Request::current()->action(),
                ));
        if (is_null(self::$current_page_with_id))
            self::$current_page_with_id = implode("_", [
                Request::current()->controller(),
                Request::current()->action(),
                Request::current()->param("id", "")
                ]);
        if (is_null(self::$options))
            self::$options = [
        "group" => ACL::get_rules(self::$current_page, array("access_level" => Buyer::instance()->get_access_level())),
        "user" => ACL::get_rules(self::$current_page, array("user_id" => Buyer::instance()->get_id())),
        "with_id" => [
        "group" => ACL::get_rules(self::$current_page_with_id, array("access_level" => Buyer::instance()->get_access_level())),
        "user" => ACL::get_rules(self::$current_page_with_id, array("user_id" => Buyer::instance()->get_id()))
        ]
        ];
    }


    public static function _($string, $id)
    {
        self::_init();
        $echo = true;
        if (isset(self::$options["group"][$id]))
            $echo = !(self::$options["group"][$id] == "hidden");
        if (isset(self::$options["user"][$id]))
            $echo = !(self::$options["user"][$id] == "hidden");

        if (isset(self::$options["with_id"]["group"][$id]))
            $echo = !(self::$options["with_id"]["group"][$id] == "hidden");
        if (isset(self::$options["with_id"]["user"][$id]))
            $echo = !(self::$options["with_id"]["user"][$id] == "hidden");

        if ($echo) {
            if (isset(self::$options["user"][$id]))
                echo '<div class ="' . $id . ' ' . self::$options["user"][$id] . '">' . $string . '</div>';
            else if (isset(self::$options["group"][$id]))
                echo '<div class ="' . $id . ' ' . self::$options["group"][$id] . '">' . $string . '</div>';
            else
                echo '<div class ="' . $id . '">' . $string . '</div>';
        }
    }

}
