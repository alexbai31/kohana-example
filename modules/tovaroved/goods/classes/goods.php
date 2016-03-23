<?php defined('SYSPATH') or die('No direct script access.');

class Goods implements IEntity
{

    private static $instance;

    public static function instance()
    {
        if (!self::$instance instanceof Goods) {
            self::$instance = new Goods();
        }
        return self::$instance;
    }

    public function create($data, $files = array())
    {

        if ($this->_validate_creating($data)) {

            foreach (array("name", "default_image") as $field) {
                $goods_data[$field] = $data[$field];
            }

            $goods = DATA::factory("goods")->set($goods_data)->save();
            if ($goods->saved()) {

                $user_id = Buyer::instance()->get_id();

                if($user_id != 0){
                    $rules = DATA::factory("acl_rules");

                    $rules->user_id = $user_id;
                    $rules->page = "goods_profile_" . $goods->id;
                    $rules->rules = json_encode(["edit_good" => "show"]);
                    $rules->save();
                }

                if (array_key_exists("properties", $data)) {
                    foreach ($data["properties"] as $index => $value) {
                        $property = DATA::factory("propertiesgoods");
                        $property->goods_id = $goods->id;
                        $property->property_id = $index;
                        if (is_numeric($value)) {
                            $property->value_numeric = $value;
                        } else {
                            $property->value = $value;
                        }
                        $property->save();
                    }

                }
                $goods->category = $data["category_id"];
                $goods->brand = $this->_get_brand($data);
                $goods->save();

                if (!empty($files)) {
                    if (!is_dir(DOCROOT . "media/img/goods/" . $goods->id))
                        mkdir(DOCROOT . "media/img/goods/" . $goods->id);

                    foreach ($files["image"]["tmp_name"] as $index => $file) {
                        $this->save_image($file, DOCROOT . "media/img/goods/" . $goods->id . "/" . ($index + 1) . ".jpg");
                    }
                }
            }

        }
    }

    public function save_image($file, $path){
        try{
            $image = Image::factory($file);
        } catch (Kohana_Exception $e){
            return;
        }
        $image
        ->resize(400, NULL)
        ->save($path);
    }

    public function delete_image($path){
        unlink($path);
    }


    private function _validate_creating($data)
    {
        $post = Validate::factory($data);

        $post
        ->rule("name", "not_empty");

        if ($post->check()) {
            return true;
        } else {
            Message::add_error($post->errors("store_creating"));
            return false;
        }
    }

    private function _get_brand($data)
    {
        if (!empty($data["brand_id"])) {
            return $data["brand_id"];
        }

        $brand = DATA::select("brand")
        ->where("name", "=", $data["brand"])
        ->limit(1)
        ->execute();

        if ($brand->loaded()) {
            return $brand->id;
        } else {
            $brand = DATA::factory("brand")->set(
                array(
                   "name" => $data["brand"]
                   )
                )->save();

            return $brand->id;
        }
    }

    public function update($id, $data, $files)
    {


        $good = DATA::select("goods", $id);
        if(!empty($data["deleting_properties"]))
            $good->remove("properties", $data["deleting_properties"]);
        $good->brand         = $this->_get_brand($data);
        $good->name          = $data["name"];
        $good->category      = $data["category_id"];
        if(isset($data["default_image"]))
            $good->default_image = str_replace(".jpg", "", $data["default_image"]);
        $good->save();

        if ($good->saved()) {
            if (array_key_exists("properties", $data)) {
                foreach ($data["properties"] as $index => $value) {
                    $property = DATA::select("propertiesgoods")
                    ->where("property_id", "=", $index)
                    ->and_where("goods_id", "=", $good->id)
                    ->limit(1)
                    ->load();
                    if(!$property->loaded())
                        $property = DATA::factory("propertiesgoods");
                    $property->goods_id = $good->id;
                    $property->property_id = $index;
                    if (is_numeric($value)) {
                        $property->value_numeric = $value;
                    } else {
                        $property->value = $value;
                    }
                    $property->save();
                }

            }
        }


        if(isset($data["deleting_images"])){
            foreach($data["deleting_images"] as $image){
                $this->delete_image(DOCROOT . "media/img/goods/" . $good->id . "/" . $image);
            }
        }
        if (!empty($files)) {
            if (!is_dir(DOCROOT . "media/img/goods/" . $good->id))
                mkdir(DOCROOT . "media/img/goods/" . $good->id);

            foreach ($files["image"]["tmp_name"] as $index => $file) {
                $this->save_image($file, DOCROOT . "media/img/goods/" . $good->id . "/" . $index . ".jpg");
            }
        }

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function count_goods_in_store($store_id){
        return Arr::flatten(DB::select(
            array(DB::expr("COUNT(price.id)"), "count")
            )
        ->from("price")
        ->where("store_id", "=", $store_id)
        ->and_where("relevance_lost", "=", null)
        ->execute()
        ->as_array());
    }

    public function count_goods_in_category($category_id)
    {
        if(! $count = Cache::instance()->get("count_goods_in_$category_id")){
            $count = DATA::select("goods")
            ->where("category_id", "=", $category_id)
            ->count();
            Cache::instance()->set("count_goods_in_$category_id", $count);
        }
        return $count;
    }

    public function count_goods(){
        return DATA::select("goods")->count();
    }

    public function get_goods($store_id, $limit, $offset){
        return DB::select(
            array("category.name", "category_name"), 
            array("price.value", "price"),
            array("currency.code", "currency"),
            array("goods.name", "name"),
            array("goods.id", "id")
            )
        ->from("price")
        ->where("store_id", "=", $store_id)
        ->and_where("relevance_lost", "=", null)
        ->join("goods")
        ->on("price.goods_id", "=", "goods.id")
        ->join("category")
        ->on("goods.category_id", "=", "category.id")
        ->join("currency")
        ->on("price.currency_id", "=", "currency.id")
        ->limit($limit)
        ->offset($offset)
        ->execute()
        ->as_array();
    }
}
