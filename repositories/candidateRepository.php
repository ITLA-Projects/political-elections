<?php

class CandidateRepository extends Repository
{

    function __construct()
    {
        parent::__construct("candidate");
    }

    function GetByPoliticalParty($politicalParty)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " . $this->table . " WHERE politicalParty = ?");
        $stmt->bind_param("i", $politicalParty);
        $stmt->execute();

        //capture the result
        $rs = $stmt->get_result();

        if ($rs->num_rows === 0) {
            return $list;
        } else {
            //there s information, proceed
            while ($row = $rs->fetch_assoc()) {
                $entity = new $this->table;
                $entity->set($row);

                array_push($list, $entity);
            }
        }

        $stmt->close();
        return $list;
    }

    function GetByElectoralPosition($electoralPosition)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " . $this->table . " WHERE electoralPosition = ?");
        $stmt->bind_param("i", $electoralPosition);
        $stmt->execute();

        //capture the result
        $rs = $stmt->get_result();

        if ($rs->num_rows === 0) {
            return $list;
        } else {
            //there s information, proceed
            while ($row = $rs->fetch_assoc()) {
                $entity = new $this->table;
                $entity->set($row);

                array_push($list, $entity);
            }
        }

        $stmt->close();
        return $list;
    }
}
