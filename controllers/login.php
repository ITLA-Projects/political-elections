<?php

class Login extends Controller
{

    private $auth;
    private $electionRepo;

    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->electionRepo = new ElectionRepository();
        //empty on every call
        $this->view->logginMessage = "";
    }

    function try()
    {
        //lets collect the info
        if (isset($_POST['username']) && isset($_POST['password'])) {

            //if is logged successfully, create a session, if not just returns false
            $isLogged = $this->auth->LoginAdmin($_POST['username'], $_POST['password']);

            //logged successfully
            if ($isLogged) {
                header("Location: ".constant('URL')."admin");
                exit();
            } else {
                //wrong credentials
                $this->view->logginMessage = "wrong credentials, try again";
                $this->render();
            }
        } else {
            //you did not fill the info, bring some message
            $this->view->logginMessage = "you need to fill the fields first";
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
                    $this->view->render('login/index');
                }else{
                    //there is a election available? go to selection
                    header("Location: " . constant('URL'));
                    exit();
                }
            }else{
                // no citizen and no user? you can go to this page then
                $this->view->render('login/index');
            }
        }
    }
}
