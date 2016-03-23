<?php defined('SYSPATH') or die('No direct script access.');

class Store implements IEntity
{
    /**
     * @var
     */
    private static $instance;

    /**
     * @return Store
     */
    public static function instance()
    {
        if (!self::$instance instanceof Store) {
            self::$instance = new Store();
        }
        return self::$instance;
    }

    /**
     * @param $data
     */
    public function create($data, $files)
    {
        


        if ($this->_validate_creating($data)) {
            foreach (array("address", "name") as $field) {
                $store_data[$field] = $data[$field];
            }
            $store_data["schedule"] = json_encode(Arr::get($data, "schedule", array("all")));
            $store_data["contacts"] = json_encode(Arr::get($data, "contacts", array()));

            $coords = file_get_contents("http://geocode-maps.yandex.ru/1.x/?format=json&geocode=" . str_replace(" ", "+", $data["address"]));
            $coords = json_decode($coords, true);
            $coords = $coords["response"]["GeoObjectCollection"]["featureMember"][0]["GeoObject"]["Point"]["pos"];

            $coords = explode(" ", $coords);

            $store_data["latitude"] = $coords[1];
            $store_data["longitude"] = $coords[0];

            $store = DATA::factory("store")->set($store_data)->save();
            if ($store->saved()) {
                if (array_key_exists("properties", $data)) {
                    foreach ($data["properties"] as $index => $value) {
                        $property = DATA::factory("propertiesstores");
                        $property->store_id = $store->id;
                        $property->property_id = $index;
                        if (!is_float($property)) {
                            $property->value = $value;
                        } else {
                            $property->value_numeric = $value;
                        }
                        $property->save();
                    }

                }


                $store->category = $data["category_id"];
                $store->chain = $this->_get_chain($data);
                $store->save();


                if (!empty($files)) {
                    if (!is_dir(DOCROOT . "media/img/stores/" . $store->id))
                        mkdir(DOCROOT . "media/img/stores/" . $store->id);

                    foreach ($files["image"]["tmp_name"] as $index => $file) {
                        move_uploaded_file($file, DOCROOT . "media/img/stores/" . $store->id . "/" . ($index + 1) . ".jpg");
                    }
                }



            }

        }

    }

    /**
     * @param $id
     */
    public function update($id)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $data
     * @return bool
     */
    private function _validate_creating($data)
    {
        $post = Validate::factory($data);

        $post
        ->rule("name", "not_empty")
        ->rule("address", "not_empty");

        if ($post->check()) {
            return true;
        } else {
            Message::add_error($post->errors("store_creating"));
            return false;
        }

    }

    /**
     * @param $store_data
     * @param $data
     */
    private function _get_chain($data)
    {
        if (!empty($data["chain_id"])) {
            return $data["chain_id"];
        }

        $chain = DATA::select("chain")
        ->where("name", "=", $data["chain"])
        ->limit(1)
        ->execute();

        if ($chain->loaded()) {
            return $chain->id;
        } else {
            $chain = DATA::factory("chain")->set(
                array(
                   "name" => $data["chain"]
                   )
                )->save();

            return $chain->id;
        }
    }

}
