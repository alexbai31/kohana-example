<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 17.09.12
 * Time: 16:07
 * To change this template use File | Settings | File Templates.
 */
class Controller_Property extends Controller_Core
{
    public function action_get_by_category()
    {
        $this->send_ajax_response(DATA::factory("property")->get_by_category($this->request->post("category_id")));
    }
}
