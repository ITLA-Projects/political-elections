<?php

class Candidate{


    public $id;
    public $firstname;
    public $lastname;
    public $photo;
    public $status;
    public $politicalParty;
    public $electoralPosition;

    public function __construct(){

    }

    public function initializeData($id,$firstname,$lastname,$photo,$status,$politicalParty,$electoralPosition){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->photo = $photo;
        $this->status = $status;
        $this->politicalParty = $politicalParty;
        $this->electoralPosition = $electoralPosition;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "sssiii";
        }else if($query === "update"){
            return "sssiiii";
        }
    }

}

?>