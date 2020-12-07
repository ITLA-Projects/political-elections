<?php

class Vote extends Controller
{

    private $auth;
    private $electoralPositionRepo;
    private $candidateRepo;
    private $resultRepo; 
    private $electionRepo;
    private $politicalPartyRepo;

    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();
        $this->electoralPositionRepo = new ElectoralPositionRepository();
        $this->candidateRepo = new CandidateRepository();
        $this->politicalPartyRepo = new PoliticalPartyRepository();
        $this->resultRepo = new ResultRepository();
        $this->electionRepo = new ElectionRepository();

        //messages & data
        $this->view->someError = "";
        $this->view->welcomeMessage = "";
        $this->view->selectedPosition = new ElectoralPosition();
        $this->view->candidateList = array();
        $this->view->politicalPartyRepo = new PoliticalPartyRepository();
    }

    function try(){
        
        //test if the POST is ready
        if(isset($_POST['candidate']) && isset($_POST['electoralPosition'])){



            try {
                $entity = new Result();

                $entity->initializeData(
                    0,
                    $_POST['candidate'],
                    $this->electionRepo->GetByStatus(true),
                    $this->auth->retrieve('citizen'),
                    $_POST['electoralPosition']
                );

                //check if the user didnt voted
                $result = $this->resultRepo->GetByElectionAndCitizenAndElectoralPosition($this->electionRepo->GetByStatus(true), $this->auth->retrieve('citizen'),$_POST['electoralPosition']);
                if($result){
                    //you found something, forget about it
                    header("Location: " . constant('URL')."selection");
                    exit();

                }else{
                    //zone clear, add
                    $this->resultRepo->Create($entity);
                    header("Location: " . constant('URL')."selection");
                    exit();
                }



            } catch (\Throwable $th) {
                //throw $th;
                var_dump($th);
                header("Location: " . constant('URL')."vote?id=".$_POST['electoralPosition']);
                exit();
            }

        }else{
            $this->view->someError = "You need to select almost 1 candidate";
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
                    //there is not a election? redirect to welcome
                    $this->auth->Logout();
                    header("Location: " . constant('URL'));
                    exit();
                }else{
                    //there is a election available? render this page
                    if (!isset($_GET['id'])) {
                        //isnt there an id for vote, go back to positions 
                        header("Location: " . constant('URL')) . "selection";
                        exit();
                    } else {
                        //everything is fine, go ahead
                        $this->view->candidateList = $this->candidateRepo->GetByElectoralPosition($_GET['id']);
                        $this->view->selectedPosition = $this->electoralPositionRepo->GetById($_GET['id']);
                        $this->view->render('vote/index');
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
