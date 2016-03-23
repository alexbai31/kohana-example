<?php

 /*
  * To change this template, choose Tools | Templates
  * and open the template in the editor.
  */

 /**
  * Description of ARRAY
  *
  * @author roman
  */
 class Jelly_Field_Array extends Jelly_Field {

     public function get($model, $value) {
         if (!is_array($value))
             return $this->_str_to_arr($value);
         else
             return $value;
     }

     private function _str_to_arr($value) {
         return json_decode(
                    preg_replace('/\"?\{/', "[", 
                               preg_replace('/\}\"?/', "]", preg_replace("/(\w+)/", '"$1"',$value))
                               ), 
                    true);
     }

     private function _arr_to_str($value) {
         return str_replace("]", "}", str_replace("[", "{", json_encode($value)));
     }

     public function set($value) {
         return $this->_arr_to_str($value);
     }

 }

?>
