<?php
 
 defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

 /**
  * Tests application security class
  * 
  * @group tovaroved.core
  * @group tovaroved.core.helpers
  * @group tovaroved.core.helpers.secure
  * 
  * 
  * */
 class SecureTest extends Kohana_Unittest_TestCase {

     function testInstance() {
         $instance = Secure::instance();

         $this->assertInstanceOf("Helper_Secure", $instance);
     }

 }

?>
