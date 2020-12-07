<?php

class ElectoralPositions extends Controller
{

    private $auth;
    private $repo;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new ElectoralPositionRepository();

        $this->view->list = array();
        $this->view->entity = "";

    }

    function add()
    {

        if (isset($_POST['name']) && isset($_POST['description'])) {

            try {
                $entity = new ElectoralPosition();
                $entity->initializeData(
                    0,
                    $_POST['name'],
                    $_POST['description'],
                    true
                );
                $this->repo->Create($entity);
            } catch (\Throwable $th) {
                var_dump($th);
                return;
            }


            //before redirect, set the photo in place

            header("Location: " . constant('URL') . "electoralPositions");
            exit();
        } else {

            $this->render("add/");
        }
    }

    function edit()
    {
        if (isset($_GET['id'])) {
            $this->view->entity = $this->repo->GetById($_GET['id']);
            $this->render("edit/");
        } else if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['description'])) {

            try {
                $entity = new ElectoralPosition();
                $entity->initializeData(
                    $_POST['id'],
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['status'] === 'on' ? true : false
                );
                $this->repo->Update($entity);
            } catch (\Throwable $th) {
                var_dump($th);
                return;
            }

            header("Location: " . constant('URL') . "electoralPositions");
            exit();
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $this->repo->Delete($_GET['id']);
            header("Location: " . constant('URL') . "electoralPositions");
            exit();
        } else {
        }
    }

    function render($where="")
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {

            $this->view->list = $this->repo->GetList();
            $this->view->render('manage/'.$where.'electoralPositions');
        } else {
            //it does not? check the authentication of the citizen

            if ($this->auth->checkAuthentication('citizen')) {
                //there is a citizen, check the elections

                $this->auth->Logout();
                header("Location: " . constant('URL'));
                exit();
            } else {
                // no citizen and no user? you can go to this page then
                header("Location: " . constant('URL') . "login");
                exit();
            }
        }
    }
}
