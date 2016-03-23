<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Core extends Controller_Template
{

    public $template = "layout/template";
    public $img_path, $css_path, $js_path, $media_path, $less_path;
    public $data = array();

    public function before()
    {
        parent::before();
        $this->template->less = array();
        $this->template->css = array();
        $this->template->js = array();
        $this->template->title = "";
        $this->template->meta = array();
        $this->template->logged = Session::instance()->get("logged");
        LESS::instance()->compile_if_need();
        $this->_setup_path();
        $this->_setup_js();
        $this->_setup_less();
        $this->_setup_css();
        $this->_setup_meta();
        $this->set_title();
    }

    private function _setup_path()
    {
        $this->media_path = $this->template->media_path = URL::base(TRUE, TRUE) . "media";
        foreach (array("img", "css", "js", "less") as $type) {
            $variable = $type . "_path";
            $this->$variable = $this->template->$variable = $this->media_path . "/$type/";
        }
    }

    private function _setup_js()
    {
        foreach (array("libraries", "map", "ajax", "ui") as $type) {
            $files = Kohana::$config->load("media.js.$type");
            for ($i = 0; $i < count($files); $i++)
                $files[$i] = $type . "/" . $files[$i];
            $this->add_media($files, "js");
        }
    }

    private function _setup_less()
    {
        $files = Kohana::$config->load("media.less");
        $this->add_media($files, "less");
    }

    private function _setup_css()
    {
        $files = Kohana::$config->load("media.css");
        $this->add_media($files, "css");
    }

    private function _setup_meta()
    {
        $meta = Kohana::$config->load("meta");
        $this->add_meta($meta);
    }

    private function _get_current_structure()
    {
        return [
        $this->request->directory(),
        $this->request->controller(),
        $this->request->action()
        ];
    }

    //PUBLIC CORE API: Use this function for sending ajax response. If $response - string, function will send just string. If array, function will send json string;
    public function send_ajax_response($response)
    {
        $this->auto_render = false;
        if (is_array($response)) {
            echo json_encode($response);
        } else {
            echo $response;
        }
    }

    //PUBLIC CORE API: Use this function for render just one part of html, not all page
    public function render_partial($view, $data = array())
    {
        $this->auto_render = false;

        return View::factory($view, $data)->render();
    }

    //PUBLIC CORE API: To set custom title for any page use this function;
    public function set_title($custom_title = "")
    {
        $const_title = Kohana::$config->load("project.title");
        $this->template->title = empty($custom_title) ? $const_title : $const_title . " | " . $custom_title;
    }

    //PUBLIC CORE API: If you need get path to styles, scripts or images you should use function $this->path_to(["css", "js", "css", "media"])
    public function path_to($folder)
    {
        $variable = $folder . "_path";
        if (property_exists($this, $variable))
            return $this->$variable;
        else
            throw new Kohana_Exception("You ask $folder but there's no requested type of media. Try 'img', 'css', 'js' or 'media'");
    }

    //PUBLIC CORE API: if you need dynamically add some media file you need call this function; Example: $this->add_media($files, ["css", "js", "less"])
    public function add_media(array $files = array(), $type = NULL)
    {
        if ($type === NULL)
            throw new Kohana_Exception("You can't call function add_media() without type of media");

        if (!empty($files)) {
            if (is_array($files)) {
                foreach ($files as $file) {
                    $this->template->{$type}[] = $file . ".$type";
                }
            } else {
                $this->template->{$type}[] = $files . ".$type";
            }
        } else {
            return;
        }
    }

    //PUBLIC CORE API: If you want add some meta tags you should call $this->add_meta(array("tag" => "content", "tag2" => "content2"))     
    public function add_meta($meta = array())
    {
        foreach ($meta as $tag => $content) {
            $this->template->meta[$tag] = $content;
        }
    }

    public function after()
    {

        $extra_data = array(
            "img_path" => $this->img_path,
            "less_path" => $this->less_path,
            "css_path" => $this->css_path,
            "js_path" => $this->js_path,
            "media_path" => $this->media_path,
            "url_base" => URL::base(TRUE, TRUE)
            );
        $this->data = array_merge($this->data, $extra_data);
        $current_view = implode(DIRECTORY_SEPARATOR, $this->_get_current_structure());
        $current_js_file = $this->_get_current_structure()[1] . "." . $this->_get_current_structure()[2];
        $current_js_path = DOCROOT . "media/js/ui/" . $current_js_file . ".js";

        if(file_exists($current_js_path)){
            $this->add_media([
              "ui/" . $current_js_file 
              ], "js");
        }
        try {
            $this->template->content = View::factory($current_view, $this->data);
        } catch (Exception $e) {
            $this->template->content = View::factory("layout/empty");
        }

        parent::after();
    }

}

?>
