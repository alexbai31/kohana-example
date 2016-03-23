<? defined('SYSPATH') or die('No direct script access.');

/**
 * undocumented class
 *
 * @package default
 * @author 
 **/
class Location implements IEntity
{

	private static $instance;

	public static function instance(){
		if(is_null(self::$instance))
			self::$instance = new Location();
		return self::$instance;
	}

	public function create($data, $files){

	}

	public function update($id){

	}

	public function delete($id){

	}	

	public function get_countries()
	{
		return DATA::factory("location")->get_countries();
	}

	public function get_childs($id){
		return DATA::factory("location")->get_childs($id);
	}
} // END class Location implements IEntity