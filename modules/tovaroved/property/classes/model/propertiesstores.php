<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 15.10.12
 * Time: 13:10
 * To change this template use File | Settings | File Templates.
 */

class Model_Propertiesstores extends Model_Core
{
    protected $_settings = array(
        "table" => "properties_stores"
    );

    public function get_store_properties($id)
    {
        return DB::select()
                ->from("properties_stores")
                ->where("properties_stores.store_id", "=", $id)
                ->join("property", "LEFT")
                ->on("properties_stores.property_id", "=", "property.id")
                ->execute()
                ->as_array();
    }

}
