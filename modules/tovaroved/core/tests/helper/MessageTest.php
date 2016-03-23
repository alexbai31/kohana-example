<?php

 defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

 /**
  * Tests application helpers
  * 
  * @group tovaroved.core
  * @group tovaroved.core.helpers
  * @group tovaroved.core.helpers.message
  * 
  * 
  * */
 class MessageTest extends Kohana_Unittest_TestCase {

     function testAddNoticeAndAddError() {
         Message::add_notice("Lalala");
         $this->assertTrue((bool) in_array("Lalala", Message::get_notices()));

         Message::add_error("Lalala");
         $this->assertTrue((bool) in_array("Lalala", Message::get_errors()));
     }

 }

?>
