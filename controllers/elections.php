<?php

class Elections extends Controller
{

    private $auth;
    private $repo;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new ElectionRepository();

        $this->view->list = array();
        $this->view->message = "";
        $this->view->exists = $this->repo->GetByStatus(true);
    }

    function initialize()
    {

        $isAny = $this->repo->GetByStatus(true);

        if ($isAny) {
            //some shit exists, you cant initialize
            $this->view->message = "You cant initialize another election if there is one active";
            header("Location: " . constant('URL') . "elections");
            exit();
        } else {
            // no election active, proceed

            if (isset($_POST['name'])) {
                $entity = new Election();
                $entity->initializeData(
                    0,
                    $_POST['name'],
                    date('Y-m-d'),
                    true
                );

                $this->repo->Create($entity);

                header("Location: " . constant('URL') . "elections");
                exit();
            } else {
                $this->render("add/");
            }
        }
    }

    function terminate()
    {

        if (isset($_GET['id'])) {

            $entity = $this->repo->GetById($_GET['id']);

            $entity->status = false;

            $this->repo->Update($entity);

            header("Location: " . constant('URL') . "elections");
            exit();
        } else {
            header("Location: " . constant('URL') . "elections");
            exit();
        }
    }

    function render($where = "")
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {

            $this->view->list = $this->repo->GetList();
            $this->view->render('manage/' . $where . 'elections');
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
