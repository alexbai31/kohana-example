<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 06.10.12
 * Time: 17:06
 * To change this template use File | Settings | File Templates.
 */
class Controller_Searchtest extends Controller_Core
{
    private $_mark = array();

    public function action_index()
    {
        if ($this->request->method() == "POST") {
            $function = $this->request->post("function");

            $this->$function();
        }

        $this->data["mark"] = $this->_mark;
        $this->data["expectation_data"] = Kohana::$config->load("expectation.queries");
    }

    public function load_data()
    {
        $source = Kohana::$config->load("source.data");

        foreach ($source as $row) {
            DATA::factory("searchtest")
                ->set($row)->save();
        }
    }

    private function _get_position($result = array(), $id)
    {
        $position = 1;

        foreach ($result as $index => $row) {
            if ($index == $id) {
                return $position;
            } else {
                $position++;
            }
        }
        return 0;
    }



    public function index_data()
    {
        echo "<pre>";
        passthru("searchd --stop");
        echo "</pre>";
        echo "<pre>";
        passthru("indexer --all");
        echo "</pre>";
        echo "<pre>";
        passthru("searchd");
        echo "</pre>";
    }
}
