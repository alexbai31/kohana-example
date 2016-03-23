<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Buyer extends Model_Core {

	protected static $_settings = array(
		"relations" => array(
			"places" => array(
				"type" => "has_many",
				"data" => array(
					""
					)
				),
			"location" => array(
				"type" => "belongs_to",
				"data" => array(
						""
					)
				)
			)
		);

}
