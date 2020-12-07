<?php

class Citizen{


    public $id;
    public $identificationCard;
    public $firstname;
    public $lastname;
    public $email;
    public $status;

    public function __construct(){

    }

    public function initializeData($id,$identificationCard,$firstname,$lastname,$email,$status){
        $this->id = $id;
        $this->identificationCard = $identificationCard;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
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