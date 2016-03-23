<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 14.10.12
 * Time: 0:28
 * To change this template use File | Settings | File Templates.
 */

class Template
{

    protected static $instance = NULL;

    private $_special_tags = [
    "[s]" => "&nbsp;",
    "[script]" => "<script type='text/javascript'>",
    "[/script]" => "</script>",
    "[p]" => "<p>",
    "[/p]" => "</p>",
    "[label]" => "<label>",
    "[/label]" => "</label>"
    ];

    public static function instance()
    {
        if (self::$instance === NULL)
            self::$instance = new Template();

        return self::$instance;
    }

    public function render($string, $variables = [], $type = NULL)
    {

        foreach ($variables as $key => $value) {
            $string = str_replace("$" . $key . "$", $value, $string);
        }

        $parts           = explode("|", $string);
        $template_string = $parts[0];
        $script          = isset($parts[1]) ? $parts[1] : NULL;
        $matches         = array();

        preg_match_all("/%.+?;?.+?%/", $template_string, $matches);

        $matches = $matches[0];

        foreach ($matches as $tag) {
            $template_string = str_replace($tag, $this->_parse_tag($tag), $template_string);
        }

        foreach ($this->_special_tags as $tag => $value) {
            $template_string = str_replace($tag, $value, $template_string);
        }

        if (!is_null($script)) {
            $script = preg_replace("/({|})/", "", $script);
            $script = HTML::script(Kohana::$config->load("template.scripts_path") . $script);
        }
        if(!is_null($type))
            $template_script = HTML::script(Kohana::$config->load("template.scripts_path") . $type . ".js");
        else
            throw new KohanaException("Please, geave me a type!");
            

        return $script . $template_string . $template_script;
    }


    private function _parse_tag($string)
    {
        $tag_string = str_replace("%", "", $string);
        $tag_array  = explode(";", $tag_string);
        $input = isset($tag_array[0]) ? $tag_array[0] : NULL;
        $attrs = isset($tag_array[1]) ? $tag_array[1] : NULL;

        if (!is_null($attrs)) {
            $attrs = explode(",", $attrs);
            foreach ($attrs as $attr) {
                $attr = explode("=", $attr);
                $attrs["parsed"][$attr[0]] = $attr[1];
            }
        }

        $attrs         = $attrs["parsed"];
        $attrs["type"] = $input;
        return Form::input(NULL, NULL, $attrs);

    }


}
