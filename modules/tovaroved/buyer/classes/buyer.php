<?php

defined('SYSPATH') or die('No direct script access.');

class Buyer implements IUser {

    private static $instance;

    public static function instance() {
        if (self::$instance === NULL)
            self::$instance = new Buyer;

        return self::$instance;
    }

    public function create($data = array()) {
        if ($this->validate_creating($data)) {
            try {
                $buyer = DATA::factory("buyer")->set($data)->save();
            } catch (Exception $e) {
                Message::add_error($e->getMessage());
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function change_region($data){
        $validation = Validation::factory($data);
        $validation->rule("region_id", "not_empty");
        if($validation->check()){
            $region_id = $data["region_id"];

            if($buyer = $this->get_model()){
                if($region_id != "-1"){
                    $buyer->location = $region_id;
                    $buyer->save();
                    $this->set_location($region_id);
                }
            } else {
                throw new Kohana_Exception("User not logged");            
            }
        } else {
            Message::add_error($validation->errors("validate_creating"));
        }
    }

    public function is_logged() {
        return Session::instance()->get("logged");
    }

    public function login($data = array()) {
        if ($this->validate_login($data)) {
            $buyer = DATA::select("buyer")->where("email", "=", $data['email'])->limit(1)->execute();
            if ($buyer->loaded()) {
                if (Secure::instance()->decrypt($buyer->password) == $data['password']) {
                    $session = Session::instance();
                    $session->set("id", $buyer->id);
                    $session->set("username", $buyer->username);
                    $session->set("email", $buyer->email);
                    $session->set("logged", TRUE);
                    $session->set("access_level", ACL::get_group("buyer"));
                    $session->set("region_id", $buyer->location->id);
                    return true;
                } else {
                    Message::add_error("Wrong password");
                    return false;
                }
            } else {
                Message::add_error("Wrong password or login");
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout() {
        return Session::instance()->destroy();
    }

    private function validate_creating($data) {
        $data = Validation::factory($data);
        //@ftr:off
        $data
        ->rule("email", "not_empty")
        ->rule("email", "email")
        ->rule("email", "Buyer::_is_unique")
        ->rule("password", "not_empty")
        ->rule("username", "not_empty");
        // @ftr: on
        if ($data->check()) {
            return true;
        } else {
            Message::add_error($data->errors("validate_creating"));
            return false;
        }
    }

    private function validate_login($data) {
        $data = Validation::factory($data);

        $data
        ->rule("email", "not_empty")
        ->rule("email", "email")
        ->rule("password", "not_empty");

        if ($data->check()) {
            return true;
        } else {
            Message::add_error($data->errors("validate_creating"));
            return false;
        }
    }

    public static function _is_unique($email) {
        $email = DATA::select("buyer")
        ->where("email", "=", $email)
        ->limit(1)
        ->execute();
        return !$email->loaded();
    }

    public function get_id() {
        return Session::instance()->get('id', 0);
    }

    public function get_access_level() {
        return Session::instance()->get("access_level", 2);
    }

    public function get_model(){
        if($this->is_logged())
            return DATA::select("buyer", $this->get_id());
        else
            return false;
    }

    public function get_location($column = NULL){
        $data = DATA::select("location", Session::instance()->get("region_id"));
        if(!is_null($column)){            
            return $data->$column;
        } else {
            return $data;
        }

    }

    public function set_location($id){
        Session::instance()->set("region_id", $id);
    }

}
