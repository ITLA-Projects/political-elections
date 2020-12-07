<?php

class AdminUser{


    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $status;

    public function __construct(){

    }

    public function initializeData($id,$username,$password,$firstname,$lastname,$status){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->status = $status;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "ssssi";
        }else if($query === "update"){
            return "ssssii";
        }
    }

}

?>