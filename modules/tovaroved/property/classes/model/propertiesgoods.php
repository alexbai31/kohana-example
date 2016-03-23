<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 15.10.12
 * Time: 13:10
 * To change this template use File | Settings | File Templates.
 */

class Model_Propertiesgoods extends Model_Core
{
    protected $_settings = array(
        "table" => "properties_goods",
        "primary_key" => "property_id"
    );

     public function get_goods_properties($id)
    {
        return DB::select()
                ->from("properties_goods")
                ->where("properties_goods.goods_id", "=", $id)
                ->join("property", "LEFT")
                ->on("properties_goods.property_id", "=", "property.id")
                ->execute()
                ->as_array();
    }

}
