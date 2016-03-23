<?

/**
* 
*/
class Controller_Price extends Controller_Core
{
	public function action_add()
	{
		Acl::check_access("4", URL::base(TRUE, TRUE));

		if($this->request->method() == "POST"){
			Price::instance()->create_from_array($this->request->post());
		}

		$this->add_media(array(
				"libraries/jquery.html",
				"libraries/jquery-ui/js/jquery-ui.min"
			), "js");
		$this->add_media(array(
				"jquery-ui/css/ui-lightness/jquery-ui.min"
			), "css");

		$this->data["stores"] = DATA::select("store")
		->execute()
		->as_array();

		$this->data["goods"] = DATA::select("goods")
		->execute()
		->as_array();

		$this->data["currencies"] = DATA::select("currency")
		->execute()
		->as_array();		
	}
}