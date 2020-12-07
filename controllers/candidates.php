<?php

class Candidates extends Controller
{

    private $auth;
    private $repo;
    private $politicalPartyRepo;
    private $electoralPositionRepo;
    private $utilities;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new CandidateRepository();
        $this->politicalPartyRepo = new PoliticalPartyRepository();
        $this->electoralPositionRepo = new ElectoralPositionRepository();
        $this->utilities = new Utilities();

        $this->view->list = array();
        $this->view->entity = "";
        $this->view->politicalPartyList = array();
        $this->view->electoralPositionList = array();
        $this->view->politicalPartyRepo = new PoliticalPartyRepository();
        $this->view->electoralPositionRepo = new ElectoralPositionRepository();
    }

    function add()
    {

        if (isset($_POST['firstname']) && isset($_POST['lastname'])  && isset($_POST['politicalParty'])  && isset($_POST['electoralPosition'])) {

            //first step - create the object, get the id
            $entity = new Candidate();
            $entity->initializeData(
                0,
                $_POST['firstname'],
                $_POST['lastname'],
                "",
                true,
                $_POST['politicalParty'],
                $_POST['electoralPosition']
            );
            $retrieve = $this->repo->Create($entity);

            $entity = $this->repo->GetById($retrieve);

            //save the picture
            $what = "";

            //the thing of the photo again
            if (isset($_FILES['photo'])) {

                $typeReplace = str_replace("image/", "", $_FILES['photo']['type']);
                $type = $_FILES['photo']['type'];
                $size = $_FILES['photo']['size'];
                $name = $retrieve . '.' . $typeReplace;
                $tmpname = $_FILES['photo']['tmp_name'];
                $success = $this->utilities->uploadPhoto('public/images/candidates/', $name, $tmpname, $type, $size);

                if ($success) {

                    $what = $name;
                }
            }

            //last, recreate the retrieve and update
            $lastResult = new Candidate();

            $lastResult->initializeData(
                $entity->id,
                $entity->firstname,
                $entity->lastname,
                $what,
                true,
                $entity->politicalParty,
                $entity->electoralPosition
            );

            $this->repo->Update($lastResult);


            //before redirect, set the photo in place


            header("Location: " . constant('URL') . "candidates");
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
        } else if (isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname'])  && isset($_POST['politicalParty'])  && isset($_POST['electoralPosition'])) {

            $what = $_POST['photo'];

            //the thing of the photo again
            if (isset($_FILES['photo'])) {

                $typeReplace = str_replace("image/", "", $_FILES['photo']['type']);
                $type = $_FILES['photo']['type'];
                $size = $_FILES['photo']['size'];
                $name = $_POST['id'] . '.' . $typeReplace;
                $tmpname = $_FILES['photo']['tmp_name'];
                $success = $this->utilities->uploadPhoto('public/images/candidates/', $name, $tmpname, $type, $size);

                if ($success) {

                    $what = $name;
                }
            }

            try {
                $entity = new Candidate();
                $entity->initializeData(
                    $_POST['id'],
                    $_POST['firstname'],
                    $_POST['lastname'],
                    $what,
                    $_POST['status'] === 'on' ? true : false,
                    $_POST['politicalParty'],
                    $_POST['electoralPosition']
                );
                $this->repo->Update($entity);
            } catch (\Throwable $th) {
                var_dump($th);
                return;
            }


            header("Location: " . constant('URL') . "candidates");
            exit();
        }
    }

    function delete()
    {
        if (isset($_GET['id'])) {
            $this->repo->Delete($_GET['id']);
            header("Location: " . constant('URL') . "candidates");
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
            $this->view->politicalPartyList = $this->politicalPartyRepo->GetByStatus(true);
            $this->view->electoralPositionList = $this->electoralPositionRepo->GetByStatus(true);;

            $this->view->render('manage/'.$where.'candidates');
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
