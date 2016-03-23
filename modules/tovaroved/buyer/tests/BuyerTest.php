<?php

 /**
  * Tests application buyer entity
  * 
  * @group tovaroved.user
  * @group tovaroved.user.buyer
  *
  * */
 class BuyerTest extends Kohana_Unittest_TestCase {

     protected $buyer;

     public function setUp() {
         $this->buyer = Buyer::instance();
     }

     public function testInterface() {
         $this->assertInstanceOf("IUser", $this->buyer);
     }

     public function providerCreating() {
         return array(
                    array("Wrong email", "", ""),
                    array("good@ema.il", "Lalala", ""),
                    array("good@ema.il", "", "Lalala"),
                    array("good@ema.il", "Lalala", "Lololo"),
         );
     }

     public function providerLogin() {
         return array(
                    array("Wrong email", "Lololo"),
                    array("good@ema.il", "Lalala"),
                    array("good@ema.il", ""),
                    array("good@ema.il", "Lololo"),
         );
     }

     public function tearDown() {
         $this->buyer->logout();
         unset($this->buyer);
     }

     public static function tearDownAfterClass() {
         $buyer = DATA::select("buyer")->where("email", "=", "good@ema.il")->load();
         $buyer->delete();
     }

 }

?>
