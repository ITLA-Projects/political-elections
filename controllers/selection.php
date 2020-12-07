<?php

class Selection extends Controller
{

    private $auth;
    private $electoralPositionRepo;
    private $electionRepo;
    private $resultRepo;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->electoralPositionRepo = new ElectoralPositionRepository();
        $this->resultRepo = new ResultRepository();
        $this->electionRepo = new ElectionRepository();

        //messages & data
        $this->view->someError = "";
        $this->view->welcomeMessage = "";
        $this->view->showTerminate = false;
        $this->view->alreadyVotedByCitizen = array();
        $this->view->positionList = array();
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
                    //there is not a election? redirect to welcome
                    $this->auth->Logout();
                    header("Location: " . constant('URL'));
                    exit();
                }else{
                    //there is a election available? render this page
                    //but before, check what the user already voted
                    /*var_dump($electionList[0]->id);
                    var_dump($this->auth->retrieve('citizen')->id);
                    var_dump($this->resultRepo->GetByElectionAndCitizen($electionList[0]->id,$this->auth->retrieve('citizen')->id));
                    return;*/
                    $this->view->alreadyVotedByCitizen = $this->resultRepo->GetByElectionAndCitizen($electionList[0]->id,$this->auth->retrieve('citizen')->id);
                    $this->view->positionList = $this->electoralPositionRepo->GetByStatus(true);

                    
                    $count = 0;
                    foreach ($this->view->positionList as $key => $position) {
                        foreach ($this->view->alreadyVotedByCitizen as $key => $result) {
                            if($result->electoralPosition === $position->id){
                                $count++;
                            }
                        }
                    }

                    //does this user already voted everything? go back welcome
                    if(count($this->view->positionList) <= $count){
                        $this->auth->Logout();
                        header("Location: " . constant('URL'));
                        exit();

                    }else{
                        //everything s fine, keep the page
                        $this->view->render('selection/index');
                    }

                }
            }else{
                // no citizen and no user? redirect to home
                header("Location: " . constant('URL'));
                exit();
            }
        }
    }
}
