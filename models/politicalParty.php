<?php

class PoliticalParty{


    public $id;
    public $name;
    public $description;
    public $logo;
    public $status;

    public function __construct(){

    }

    public function initializeData($id,$name,$description,$logo,$status){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->logo = $logo;
        $this->status = $status;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "sssi";
        }else if($query === "update"){
            return "sssii";
        }
    }

}

?>