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
class Model_Goods extends Model_Core
{
    protected static $_settings = array(
        'relations' => array(
            'category' => array(
                'type' => 'belongs_to',
                'data' => array(
                    'foreign' => 'category.id',
                    )
                ),
            'brand' => array(
                'type' => 'belongs_to',
                'data' => array(
                    'foreign' => 'brand.id',
                    )
                ),
//            'region' => array(
//                'type' => 'belongs_to',
//                'data' => array(
//                    'foreign' => 'region.id',
//                )
//            ),
            'properties' => array(
                'type' => 'many_to_many',
                "data" => array(
                    "through" => array(
                        'model' => 'properties_goods',
                        'columns' => array("goods_id", "property_id")
                        )
                    )
                )


            ));

    public function get_goods_categories()
    {
        return DB::select()
        ->from("category")
        ->where("type", "=", "goods")
        ->execute()
        ->as_array();
    }

    public function get_goods_info($as_array = TRUE)
    {
        $data = DATA::select("property")
        ->with("template")
        ->where("category_id", "IN", DB::select("id")
         ->from("category")
         ->where("type", "=", "goods_more_info")
         ->execute()
         ->as_array())
        ->execute();

        if($as_array)
            return $data->as_array();

        return $data;
    }
}

?>
