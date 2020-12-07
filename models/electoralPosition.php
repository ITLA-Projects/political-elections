<?php

class ElectoralPosition{


    public $id;
    public $name;
    public $description;
    public $status;

    public function __construct(){

    }

    public function initializeData($id,$name,$description,$status){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
    }

    public function set($data){
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function getKeyTypes($query){
        if($query === "create"){
            return "ssi";
        }else if($query === "update"){
            return "ssii";
        }
    }

}

?>