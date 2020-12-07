<?php

class Candidates extends Controller
{

    private $auth;
    private $repo;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new CandidateRepository();

        $this->view->list = array();
        $this->view->politicalRepo = new PoliticalPartyRepository();
        $this->view->electoralPositionRepo = new ElectoralPositionRepository();
    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {

            $this->view->list = $this->repo->GetList();
            $this->view->render('manage/candidates');
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
