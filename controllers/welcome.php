<?php

class Welcome extends Controller
{

    private $auth;
    private $electionRepo;

    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->electionRepo = new ElectionRepository();

       //error messages
        $this->view->someError = "";
    }

    /**
     * Method used to go through the votations
     */
    function enter()
    {

        //lets collect the info
        if (isset($_POST['identificationCard'])) {

            //if is logged successfully, create a session, if not just returns false
            $isLogged = $this->auth->LoginCitizen($_POST['identificationCard']);

            //logged successfully
            if ($isLogged) {
                header("Location: " . constant('URL') . "selection");
                exit();
            } else {
                //wrong credentials
                $this->view->someError = "this ID does not exists in this database";
                $this->render();
            }
        } else {
            //you did not fill the info, bring some message
            $this->view->someError = "you need to fill the fields first";
            $this->render();
        }
    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {
            header("Location: " . constant('URL') . "admin");
            exit();
        } else {
            //it does not? check the authentication of the citizen

            if($this->auth->checkAuthentication('citizen')){
                //there is a citizen, check the elections
                $electionList = $this->electionRepo->GetByStatus(true);

                if(!$electionList){
                    //there is not a election? ok, go to this page and redirect
                    $this->auth->Logout();
                    $this->view->someError="You cannot select because there is no election open at the moment";
                    $this->view->render('index');
                }else{
                    //there is a election available? go to selection
                    header("Location: " . constant('URL')."selection");
                    exit();
                }
            }else{
                // no citizen and no user? you can go to this page then
                $this->view->render('index');
            }
        }
    }

}
