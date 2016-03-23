<?php
/**
 * Created by JetBrains PhpStorm.
 * User: roman
 * Date: 17.09.12
 * Time: 16:15
 * To change this template use File | Settings | File Templates.
 */
class Model_Property extends Model_Core
{
    protected $_settings = array(
        'relations' => array(
            "template" => array(
                "type" => "belongs_to",
                "data" => array(
                    "foreign" => "template.id"
                    )
                )
            )
        );

    public function get_contact_types()
    {

        return DATA::select("property")
        ->where("category_id", "IN", DB::select("id")
           ->from("category")
           ->where("type", "=", "store_info_contacts")
           ->execute()
           ->as_array())
        ->execute()
        ->as_array();

    }

    public function get_store_info()
    {
        return DATA::select("property")
        ->where("category_id", "IN", DB::select("id")
           ->from("category")
           ->where("type", "=", "store_info_more")
           ->execute()
           ->as_array())
        ->execute()
        ->as_array();
    }

    public function get_by_category($value='')
    {
         if (!$result = Cache::instance()->get($query)) {
            $result = DATA::select("property")
            ->where("category_id", "=", $query)
            ->execute()
            ->as_array();
            Cache::instance()->set($query, $result);
        }
        return $result;
    }



}
