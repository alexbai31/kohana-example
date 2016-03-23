<?php

 /*
  * To change this template, choose Tools | Templates
  * and open the template in the editor.
  */

 /**
  * Description of buyer
  *
  * @author roman
  */
 class Controller_Buyer extends Controller_Core {

     public function action_create() {
         if ($this->request->method() == "POST") {
             $data = array();
             foreach ($this->request->post() as $key => $field) {
                 $data[str_replace("buyer_", "", $key)] = $field;
             }

             $data['password'] = Secure::instance()->crypt($data['password']);

             if (Buyer::instance()->create($data)) {
                 $this->request->redirect(URL::base(TRUE, TRUE));
             }
         }
     }

     public function action_login() {
         if ($this->request->method() == "POST") {
             $data = array();
             foreach ($this->request->post() as $key => $field) {
                 $data[str_replace("buyer_", "", $key)] = $field;
             }
             if (Buyer::instance()->login($data)) {
                 $this->request->redirect(URL::base(TRUE, TRUE));
             }
         }
     }

     public function action_logout() {
         if (Buyer::instance()->logout()) {
             $this->request->redirect(URL::base(TRUE, TRUE));
         }
     }

     public function action_profile(){
        $id = $this->request->param("id");
        $this->data['profile'] = DATA::select("buyer", $id);
    }

    public function action_edit_profile()
    {
        $id = $this->request->param("id");
        if ($this->request->method() == "POST") {
            Buyer::instance()->change_region($this->request->post());
        }
        $this->data["countries"] = Location::instance()->get_countries();
    }

    public function action_get_location(){
        $id = $this->request->param("id");

        $this->send_ajax_response(Location::instance()->get_childs($id));
    }

}
?>
