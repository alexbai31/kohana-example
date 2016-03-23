<?php

interface IUser
{

    public function is_logged();

    public function create($data = array());

    public function login($data = array());

    public function logout();
}

?>
