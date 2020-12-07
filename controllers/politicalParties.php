<?php

class PoliticalParties extends Controller
{

    private $auth;
    private $repo;
    private $utilities;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new PoliticalPartyRepository();
        $this->utilities = new Utilities();

        $this->view->list = array();
        $this->view->entity = "";
    }

    function add()
    {

        if (isset($_POST['name']) && isset($_POST['description'])) {

            $what = "";

            //the thing of the photo again
            if (isset($_FILES['logo'])) {

                $typeReplace = str_replace("image/", "", $_FILES['logo']['type']);
                $type = $_FILES['logo']['type'];
                $size = $_FILES['logo']['size'];
                $name = $_POST['name'] . '.' . $typeReplace;
                $tmpname = $_FILES['logo']['tmp_name'];
                $success = $this->utilities->uploadPhoto('public/images/logos/', $name, $tmpname, $type, $size);

                if ($success) {

                    $what = $name;
                }
            }


            try {
                $entity = new PoliticalParty();
                $entity->initializeData(
                    0,
                    $_POST['name'],
                    $_POST['description'],
                    $what,
                    true
                );
                $this->repo->Create($entity);
            } catch (\Throwable $th) {
                var_dump($th);
                return;
            }


            //before redirect, set the photo in place


            header("Location: " . constant('URL') . "politicalParties");
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

            $what = $_POST['photo'];

            //the thing of the photo again
            if (isset($_FILES['logo'])) {

                $typeReplace = str_replace("image/", "", $_FILES['logo']['type']);
                $type = $_FILES['logo']['type'];
                $size = $_FILES['logo']['size'];
                $name = $_POST['name'] . '.' . $typeReplace;
                $tmpname = $_FILES['logo']['tmp_name'];
                $success = $this->utilities->uploadPhoto('public/images/logos/', $name, $tmpname, $type, $size);

                if ($success) {

                    $what = $name;
                }
            }


            try {
                $entity = new PoliticalParty();
                $entity->initializeData(
                    $_POST['id'],
                    $_POST['name'],
                    $_POST['description'],
                    $what,
                    $_POST['status'] === 'on' ? true : false
                );
                $this->repo->Update($entity);
            } catch (\Throwable $th) {
                var_dump($th);
                return;
            }


            header("Location: " . constant('URL') . "politicalParties");
            exit();
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $this->repo->Delete($_GET['id']);
            header("Location: " . constant('URL') . "politicalParties");
            exit();
        } else {
        }
    }

    function render($where = "")
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {

            $this->view->list = $this->repo->GetList();
            $this->view->render('manage/' . $where . 'politicalParties');
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
