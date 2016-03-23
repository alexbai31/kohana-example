<? defined('SYSPATH') or die('No direct script access.');

/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class Model_Location extends Model_Core
{
	protected $_settings = array(
			"table" => "locations"
		);

	public function get_countries()			
	{
		return DB::select("*")
		->from("locations")
		->where("type_id", "IN", DB::select("id")
			->from("location_types")
			->where("code", "=", "country")
			->execute()
			->as_array()
			)
		->execute()
		->as_array();

	}

	public function get_childs($id)			
	{
		return DB::select("*")
		->from("locations")
		->where("parent_id", "=", $id)
		->execute()
		->as_array();

	}
} 