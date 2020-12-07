<?php

class Admin extends Controller
{

    private $auth;


    function __construct()
    {
        parent::__construct();
        $this->auth = new Auth();


    }

    function render()
    {
        //before render, you need to check the authentication

        //does a user exists? is admin, prevent render
        if ($this->auth->checkAuthentication()) {
            $this->view->render('admin/index');
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
