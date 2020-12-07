<?php

class Results extends Controller
{

    private $auth;
    private $repo;
    private $electoralPositionRepo;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->repo = new ResultRepository();
        $this->electoralPositionRepo = new ElectoralPositionRepository();

        $this->view->list = array();
    }



    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {


            if (isset($_GET['id'])) {
                /*CONVERGE EVERYTHING HERE*/
                $final_array = array();

                $electionList = $this->repo->GetByElection($_GET['id']);

                //now, you need to divide this formula into positions
                //1- get the positions that were involved in the election
                $electoralPositionCompleteList = $this->electoralPositionRepo->GetList();

                $participatingPositions = array();

                foreach ($electoralPositionCompleteList as $electoralPosition) {

                    $match = false;

                   foreach ($electionList as $election) {
                       if($election->electoralPosition === $electoralPosition->id){
                           $match = true;
                       }
                   }

                   if($match){
                    array_push($participatingPositions,$electoralPosition);
                   }
                }

                //2- create you assc arrays to complete this
                foreach ($participatingPositions as $key => $position) {
                    $newFinalArr = array();

                    $results = $this->repo->GetByElectionAndElectoralPosition($_GET['id'],$position->id);

                    //guess you need to do the same freaking thing with the candidates?
                }


                $this->view->list = $this->repo->GetList();
                $this->view->render('manage/results');
            } else {
                header("Location: " . constant('URL') . "admin");
                exit();
            }
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
