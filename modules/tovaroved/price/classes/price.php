<?


class Price_Bad_Array_Exception extends Kohana_Exception{}

class Price implements IEntity
{
	private static $instance;

	public static function instance(){
		if(is_null(self::$instance)){
			self::$instance = new Price;
		}
		return self::$instance;
	}

	public function create($data, $files = array()){

	}

	public function create_from_array($data){
		$data = $data["prices"];
		$buyer_id = Buyer::instance()->get_id();
		$query = DB::insert("price", array("store_id", "goods_id", "buyer_id", "currency_id", "date", "value"));
		foreach ($data as $index => $value) {
			$store_id = $value["store_id"];
			$date = strtotime($value["date"]);
			foreach ($value["good"] as $index => $good_id) {
				$query->values(array($store_id, $good_id, $buyer_id, $value["currency"][$index], $date, $value["price"][$index]));
			}
		}

		return $query->execute();
	}

	public function update($id, $data, $files){

	}

	public function delete($id){
		
	}

	public function get_price($goods_id, $aggregation = ""){
		if(!empty($aggregation))
			return DB::select()
		->from("price")
		->where("value", "IN", DB::select(array(DB::expr("$aggregation(value)"), "value"))
			->from("price")
			->where("goods_id", "=", $goods_id)
			->and_where("buyer_id", "IN", DB::select("id")
				->from("buyer")
				->where("location_id", "=", Buyer::instance()->get_location("id")))
			->execute()
			->as_array())
		->and_where("relevance_lost", "=", null)
		->join("currency")
		->on("price.currency_id", "=", "currency.id")
		->execute()
		->as_array();
	}
}