<?php  defined('SYSPATH') or die('No direct script access.');
class Model_Store extends Model_Core
{

    protected static $_settings = array(
        'relations' => array(
            'category' => array(
                'type' => 'belongs_to',
                'data' => array(
                    'foreign' => 'category.id',
                )
            ),
            'chain' => array(
                'type' => 'belongs_to',
                'data' => array(
                    'foreign' => 'chain.id',
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
                        'model' => 'properties_stores',
                        'columns' => array("store_id", "property_id")
                    )
                )
            )


        ));

    public function get_store_categories()
    {
        return DATA::select("category")
            ->where("type", "=", "store")
            ->execute()
            ->as_array();
    }


}

?>
