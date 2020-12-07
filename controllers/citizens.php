<?php

class Citizens extends Controller
{

    private $auth;
    private $repo;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new CitizenRepository();


        $this->view->list = array();
        $this->view->entity = "";
    }

    function add(){

        if(isset($_POST['identificationCard']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])){
            $entity = new Citizen();
            $entity->initializeData(
                0,
                $_POST['identificationCard'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                true
            );
            $this->repo->Create($entity);
            header("Location: " . constant('URL')."citizens");
            exit();
        }else{
            $this->render("add/");
        }
    }

    function edit(){
        if(isset($_GET['id'])){
            $this->view->entity = $this->repo->GetById($_GET['id']);
            $this->render("edit/");

        }else if(isset($_POST['id']) && isset($_POST['identificationCard']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email'])){
            $entity = new Citizen();

            //var_dump($_POST['identificationCard']);
           // return;

            $entity->initializeData(
                $_POST['id'],
                $_POST['identificationCard'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['status'] === "on" ? true : false
            );
            $this->repo->Update($entity);
            header("Location: " . constant('URL')."citizens");
            exit();
        }
    }

    function delete(){
        if(isset($_GET['id'])){
            $this->repo->Delete($_GET['id']);
            header("Location: " . constant('URL')."citizens");
            exit();
        }else{

        }
    }

    function render($where="")
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {

            $this->view->list = $this->repo->GetList();
            $this->view->render('manage/'.$where.'citizen');
        } else {
            //it does not? check the authentication of the citizen

            if($this->auth->checkAuthentication('citizen')){
                //there is a citizen, check the elections

                $this->auth->Logout();
                header("Location: " . constant('URL'));
                exit();
            }else{
                // no citizen and no user? you can go to this page then
                header("Location: " . constant('URL')."login");
                exit();
            }
        }
    }
}
