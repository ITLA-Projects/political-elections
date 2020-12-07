<?php

class Auth
{
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }

    function LoginAdmin($user, $password)
    {
        //check session
        $this->checkSession();

        $stmt = $this->db->conn->prepare("SELECT * FROM adminUser WHERE username = ? and password = ?");
        $stmt->bind_param("ss", $user, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return false;
        } else {
            $entity = $result->fetch_assoc();

            $adminUser = new AdminUser();

            $adminUser->set($entity);

            $_SESSION['user'] = json_encode($adminUser);
            return true;
        }
    }

    function LoginCitizen($identificationCard)
    {
        //check session
        $this->checkSession();

        $stmt = $this->db->conn->prepare("SELECT * FROM citizen WHERE identificationCard = ?");
        $stmt->bind_param("s", $identificationCard);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0) {
            return false;
        } else {
            $entity = $result->fetch_assoc();

            $citizen = new Citizen();

            $citizen->set($entity);

            $_SESSION['citizen'] = json_encode($citizen);
            return true;
        }
    }

    function Logout()
    {
        //check session
        $this->checkSession();

        try {
            session_destroy();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * check if there is a user authenticated
     */
    function checkAuthentication($target = 'user')
    {
        //check session
        $this->checkSession();

        //does user variable exists?
        if (isset($_SESSION[$target])) {


            //does have any value
            if ($_SESSION[$target] == null) {
                $_SESSION['messageAuth'] = "You must Login/Set credentials first";

                return false;
            } else {
                return true;
            }
        } else {
            $_SESSION['messageAuth'] = "You must Login/Set credentials first";

            return false;
        }
    }

    function retrieve($target = 'user')
    {
        //check session
        $this->checkSession();

        //you can only retrieve the user if you are already logged
        if ($this->checkAuthentication($target)) {
            return json_decode($_SESSION[$target]);
        } else {
            //but to prevent errors, just retrieve an empty object
            if ($target === 'user') {
                $object = new AdminUser();
                $object->initializeData(0, "", "", "", "", 0);
                return $object;
            } else if ($target === 'citizen') {
                $object = new Citizen();
                $object->initializeData(0, 0, "", "", "", 0);
                return $object;
            } else {
                return null;
            }
        }
    }

    private function checkSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
