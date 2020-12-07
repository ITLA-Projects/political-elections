<?php

class Result{


    public $id;
    public $candidate;
    public $election;
    public $citizen;
    public $electoralPosition;


    public function __construct(){

    }

    public function initializeData($id,$candidate,$election,$citizen,$electoralPosition){
        $this->id = $id;
        $this->candidate = $candidate;
        $this->election = $election;
        $this->citizen = $citizen;
        $this->electoralPosition = $electoralPosition;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "iiii";
        }else if($query === "update"){
            return "iiiii";
        }
    }

}

?>