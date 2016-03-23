<? 
defined('SYSPATH') or die('No direct script access.');

class Arr extends Kohana_Arr{
	public static function in_multi_array($needle, $haystack) 
	{ 
		$in_multi_array = false; 
		if(in_array($needle, $haystack)) 
		{ 
			$in_multi_array = true; 
		} 
		else 
		{ 
			for($i = 0; $i < sizeof($haystack); $i++) 
			{ 
				if(is_array($haystack[$i])) 
				{ 
					if(in_multi_array($needle, $haystack[$i])) 
					{ 
						$in_multi_array = true; 
						break; 
					} 
				} 
			} 
		} 
		return $in_multi_array; 
	} 
}