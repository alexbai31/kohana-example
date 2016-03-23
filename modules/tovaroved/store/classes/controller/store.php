<?php  defined('SYSPATH') or die('No direct script access.');

class Controller_Store extends Controller_Core
{


    public function action_index()
    {
        $this->data["stores"] = DATA::select("store")->execute();
    }

    public function action_profile()
    {

        $id = $this->request->param('id');

        $store = DATA::select("store", $id);

        if ($store->loaded()) {
            $this->data = $store->as_array();
            $this->data["store_properties"] = DATA::factory("propertiesstores")->get_store_properties($id);
        } else {
            throw new Kohana_HTTP_Exception_404();
        }

        if (!is_null($store->latitude) || !is_null($store->longitude)) {
            $vars = array(
                "coordinates" =>
                "'(" . $store->latitude . ", " . $store->longitude . ")'",
                "name" => "'" . $store->name . "'",
                "body" => "'" . $store->address . "'"
                );
        } else {
            $vars = array();
        }
        $this->data["id"] = $id;
        $this->data["map"] = Map::factory("yandex")->render(array("store.profile"), $vars);

        if (is_dir(DOCROOT . "media/img/stores/" . $store->id)) {
            $images = scandir(DOCROOT . "media/img/stores/" . $store->id);
            array_shift($images);
            array_shift($images);

            $this->data["images"] = $images;
        }


    }

    public function action_edit(){

        $id = $this->request->param("id");

        $store = DATA::select("store", $id);

        if(!$store->loaded())
            throw new Kohana_HTTP_Exception_404();

        $this->data["store"] = print_r($store, true);
            
    }

    public function action_catalog(){
        $id = $this->request->param("id");
        $count = Goods::instance()->count_goods_in_store($id);
        $pagination = Pagination::factory( ["total_items" => $count["count"]])
        ->route_params([
            'controller' => Request::current()->controller(),
            'action' => Request::current()->action(),
            'id' => $id
            ]);
        $this->data["goods"] = Goods::instance()->get_goods($id, $pagination->items_per_page, $pagination->offset);
        $this->data["pagination"] = $pagination;
    }

    public function action_add()
    {
        Acl::check_access("4", URL::base(TRUE, TRUE));
        if (Request::$current->method() == "POST") {
            Store::instance()->create($this->request->post(), $_FILES);
        }
        $this->add_media([
          "libraries/autocomplete",
          ],
        "js");


        $types = DATA::factory("property")->get_contact_types();
        $this->data["contact_types"][0] = "Выберите тип...";
        foreach ($types as $type) {
            $this->data["contact_types"][$type["id"]] = $type["name"];
        }
        $types = DATA::factory("property")->get_store_info();
        $this->data["info_types"][0] = "Выберите тип...";
        foreach ($types as $type) {
            $this->data["info_types"][$type["id"]] = $type["name"];
        }
        $categories = DATA::factory("store")->get_store_categories();
        $this->data['categories'] = array();
        $this->data['map'] = Map::factory("yandex")->render(array("store.add"));
        foreach ($categories as $category) {
            $this->data['categories'][$category['id']] = $category['name'];
        }
    }


    public function action_get_form()
    {
        $template = Template::instance();
        $id = $this->request->post("id");
        $property = DATA::select("property", $id);
        $this->send_ajax_response($template->render($property->template->body));
    }
}

?>
