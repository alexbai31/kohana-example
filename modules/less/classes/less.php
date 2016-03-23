<?php

 defined('SYSPATH') or die('No direct script access.');

 class LESS extends Lessc {

     private static $instance;

     public static function instance() {
         if (self::$instance === NULL)
             self::$instance = new LESS;

         return self::$instance;
     }

     public function compile_if_need() {
         $input = Kohana::$config->load("less.input_file");
         $output = Kohana::$config->load("less.output_file");

         try {
             $this->checkedCompile($input, $output);
         } catch (exception $e) {
             throw new Kohana_Exception($e->getMessage());
         }
     }

 }

?>
