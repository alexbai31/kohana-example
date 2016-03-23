<?php  defined('SYSPATH') or die('No direct script access.');
/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

/**
 * Description of store
 *
 * @author roman
 */
class Controller_Goods extends Controller_Core{



    public function action_index(){        
        $count = Goods::instance()->count_goods();
        $pagination = Pagination::factory(["total_items" => $count, "items_per_page" => 10])
        ->route_params([
            'controller' => Request::current()->controller(),
            'action' => Request::current()->action(),
            ]);
        $this->data["goods"] = DATA::select("goods")
        ->limit($pagination->items_per_page)
        ->offset($pagination->offset)
        ->execute()
        ->as_array();
        $this->_render_index_page($pagination);
    }

    public function action_search(){
        $sphinx         = Search::factory("sphinx");
        $result         = $sphinx->search($this->request->post("query"));
        $category       = (int) $this->request->post("category");
        $properties     = $this->request->post("property");
        $types          = $this->request->post("type");
        $items_per_page = (int) $this->request->post("items_per_page");
        if($category != 0) 
            $result->filter("category_id", [$category]);
        $result      = $result->execute();
        $pagination  = Pagination::factory(["total_items" => $result["total"], "items_per_page" => $items_per_page])
        ->route_params([
            'controller' => Request::current()->controller(),
            'action'     => Request::current()->action(),
            ]);
        if(!empty($result["matches"])){
         $goods = DATA::select("goods")
         ->where("id", "IN", array_keys($result["matches"])); 
         if(!empty($properties)){     
             foreach ($properties as $id => $value) {
                switch($types[$id]){
                    case "between":
                    if(!empty($value["from"]) && !empty($value["to"])){
                        $diapason = DB::select("goods_id")
                        ->from("properties_goods")
                        ->where("value_numeric", "BETWEEN", [$value["from"], $value["to"]])
                        ->execute()
                        ->as_array();
                        $goods->and_where("id", "IN", Arr::flatten(!empty($diapason)? $diapason :[0]));
                    }
                    break;
                    case "bool":
                    $diapason = DB::select("goods_id")
                        ->from("properties_goods")
                        ->where("value", "=", $value)
                        ->execute()
                        ->as_array();                        
                    $goods->and_where("id", "IN", Arr::flatten(!empty($diapason)? $diapason :[0]));
                    break;
                }
            }
        }

        $goods = $goods->limit($pagination->items_per_page)
        ->offset($pagination->offset);
        
        $goods = $goods->execute();

        $this->data["goods"] = $goods->as_array();
    } else {
        $this->data["goods"] = [];
    }
    $this->_render_index_page($pagination);        
}

public function action_get_filters(){    
    $category_id = $this->request->param("id");

    $propertieslist = DATA::factory("property")->get_by_category($category_id);
}

private function _render_index_page($pagination){
    $this->data["pagination"] = $pagination; 
    $categories = DATA::factory("goods")->get_goods_categories();
    $properties = DATA::factory("goods")->get_goods_info(false);
    foreach ($properties as $property) {
        $this->data["properties"]["name"][] = $property->name;
        $this->data["properties"]["form"][] = Template::instance()->render($property->template->body_searching, [
            "property_name" => $property->name,
            "property_id" => $property->id
            ], strtolower($property->template->name) . ".searching");
    }

    $sorted_cats = [];
    foreach ($categories as $index => $category) {
        $count = Goods::instance()->count_goods_in_category($category["id"]);
        $sorted_cats[ (int) $category["parent_id"]][] = [
        "name" => $category["name"],
        "id" => $category["id"],
        "count" => $count
        ];
    }
    $this->data["categories"] = Form::option("Выберите категорию", 0);
    $this->_build_tree($sorted_cats, array_keys($sorted_cats)[0], 0);

}

private function _build_tree($categories = [], $start_index, $lines_number){
    $lines = "";

    for($i = 0; $i < $lines_number; $i++)
     $lines .= "-";
 if(!empty($categories)){
     foreach ($categories[$start_index] as $index => $value) {
        if($value["count"] != 0)
            $this->data["categories"] .= Form::option($lines . $value["name"] . " (" . $value["count"] . ")" , $value["id"]);

        if(isset($categories[$value["id"]])){
            $this->_build_tree($categories, $value["id"], $lines_number + 1);
        }
    }
}


}

public function action_add(){
    Acl::check_access("4", URL::base(TRUE, TRUE));
    if (Request::$current->method() == "POST") {
        Goods::instance()->create($this->request->post(), $_FILES);
    }
    $this->add_media([
      "libraries/autocomplete",
      ],
      "js");
    $types = DATA::factory("goods")->get_goods_info();
    $this->data["info_types"][0] = "Выберите тип...";
    foreach ($types as $type) {
        $this->data["info_types"][$type["id"]] = $type["name"];
    }
    $categories = DATA::factory("goods")->get_goods_categories();

    foreach ($categories as $category) {
        $this->data['categories'][$category['id']] = $category['name'];
    }
}

public function action_get_form(){
    $template = Template::instance();        
    $id       = $this->request->post("id");        
    $property = DATA::select("property", $id);

    $this->send_ajax_response($template->render($property->template->body_editing, [
        "property_name"   => $property->name, 
        "property_id"     => $property->id,
        "block_to_append" => ".propertieslist",
        ], strtolower($property->template->name) . ".editing"));
}

public function action_edit(){
    Acl::check_access("4", URL::base(TRUE, TRUE));

    $id = $this->request->param("id");

    if (Request::$current->method() == "POST") {
        Goods::instance()->update($id, $this->request->post(), $_FILES);
    }
    $this->add_media([
      "libraries/autocomplete",
      "libraries/jquery.html",
      "libraries/lightbox/js/lightbox.min"
      ],
      "js");

    $this->add_media([
        "lightbox/css/lightbox"
        ], "css");
    $types = DATA::factory("goods")->get_goods_info();
    $this->data["info_types"][0] = "Выберите тип...";
    foreach ($types as $type) {
        $this->data["info_types"][$type["id"]] = $type["name"];
    }
    $categories = DATA::factory("goods")->get_goods_categories();

    foreach ($categories as $category) {
        $this->data['categories'][$category['id']] = $category['name'];
    }

    $profile = DATA::select("goods")
    ->with("category")
    ->with("brand")
    ->load($id);

    $this->data["current_category"] = $profile->category->id;        
    $this->data["current_brand"]    = $profile->brand->name;       
    $this->data["current_brand_id"] = $profile->brand->id;        
    $this->data["current_name"]     = $profile->name;        
    $this->data["goods_properties"] = DATA::factory("propertiesgoods")->get_goods_properties($id);        
    $this->data["current_id"]       = $id;        
    $this->data["default_image"]    = $profile->default_image;

    if (is_dir(DOCROOT . "media/img/goods/" . $profile->id)) {
        $images = scandir(DOCROOT . "media/img/goods/" . $profile->id);
        array_shift($images);
        array_shift($images);


        $this->data["images"] = $images;

    }
}

public function action_profile(){

    $this->add_media([
        "libraries/lightbox/js/lightbox.min"
        ], "js");

    $this->add_media([
        "lightbox/css/lightbox"
        ], "css");

    $id = $this->request->param("id");
    $good = DATA::select("goods", $id);

    if(!$good->loaded())
        throw new HTTP_Exception_404("Товар не найден");


    $this->data["max_price"] = Price::instance()->get_price($id, "MAX");
    $this->data["min_price"] = Price::instance()->get_price($id, "MIN");



    $this->data["profile"] = $good;
    $this->data["category"] = $good->category;
    $this->data["goods_properties"] = DATA::factory("propertiesgoods")->get_goods_properties($id);

    if (is_dir(DOCROOT . "media/img/goods/" . $good->id)) {
        $images = scandir(DOCROOT . "media/img/goods/" . $good->id);
        array_shift($images);
        array_shift($images);


        $this->data["images"] = $images;
    }
}
}



?>
