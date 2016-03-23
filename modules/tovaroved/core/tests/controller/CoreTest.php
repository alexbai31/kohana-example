<?php

 defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');

 /**
  * Tests application controller core
  * 
  * @group tovaroved.core
  * @group tovaroved.core.controller
  *
  * */
 class CoreTest extends Kohana_Unittest_TestCase {

     public function testAjaxResponse() {
         $controller = new Controller_Core(new Request(""), new Response());
         ob_start();
         $controller->send_ajax_response("Lalala");
         $contents = ob_get_contents();
         ob_end_clean();
         $this->assertEquals("Lalala", $contents);
         ob_start();
         $controller->send_ajax_response(array("Lalala", "Ololo"));
         $contents = ob_get_contents();
         ob_end_clean();
         $this->assertEquals(json_encode(array("Lalala", "Ololo")), $contents);
     }

     public function testSetTile() {
         $const_title = Kohana::$config->load("project.title");
         $controller = new Controller_Core(new Request(""), new Response());
         $controller->before();
         $this->assertEquals($const_title, $controller->template->title);
         $controller->set_title("Ololo");
         $this->assertStringEndsWith($const_title . " | " . "Ololo", $controller->template->title);
     }

     public function testPathTo() {
         $controller = new Controller_Core(new Request(""), new Response());
         $controller->before();

         $this->assertEquals($controller->css_path, $controller->path_to("css"));

         try {
             $controller->path_to("Lalala");
         } catch (Exception $e) {
             return;
         }
         $this->fail("Expected exception with message 'You ask Lalala but there's no requested type of media. Try 'img', 'css', 'js' or 'media'' must be throwed");
     }

     /**
      * @expectedException        Kohana_Exception
      * @expectedExceptionMessage You can't call function add_media() without type of media
      */
     function testAddMediaException() {
         $controller = new Controller_Core(new Request(""), new Response());
         $controller->add_media();
     }

     function testAddMedia() {
         $controller = new Controller_Core(new Request(""), new Response());
         $controller->before();
         $controller->add_media("test", 'js');
         $this->assertTrue((bool) array_search("test.js", $controller->template->js));
         $files = array("lolo", "lala", "lili");
         $controller->add_media($files, "js");
         foreach ($files as $file) {
             $this->assertTrue((bool) array_search("$file.js", $controller->template->js));
         }
     }

     function testAddMeta() {
         $controller = new Controller_Core(new Request(""), new Response());
         $controller->before();
         $controller->add_meta(array("tag" => "content"));
         $this->assertEquals("content", $controller->template->meta["tag"]);
     }

     function testRenderPartial() {
         $controller = new Controller_Core(new Request(""), new Response());
         $controller->before();
         ob_start();
         $controller->render_partial("layout/empty");
         $contents = ob_get_contents();
         ob_end_clean();
         ob_start();
         View::factory("layout/empty")->render();
         $expected = ob_get_contents();
         ob_end_clean();
         $this->assertEquals($expected, $contents);
     }

 }

?>
