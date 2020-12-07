<?php

class Election{


    public $id;
    public $name;
    public $date;
    public $status;

    public function __construct(){

    }

    public function initializeData($id,$name,$date,$status){
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
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