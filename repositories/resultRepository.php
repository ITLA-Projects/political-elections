<?php

class ResultRepository extends Repository
{

    function __construct()
    {
        parent::__construct("result");
    }

    function GetByElectionAndCitizenAndElectoralPosition($election,$citizen,$electoralPosition)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " .$this->table. " WHERE election = ? AND citizen = ? AND electoralPosition = ?");
        $stmt->bind_param("iii", $election,$citizen,$electoralPosition);
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

    function GetByElectionAndCitizen($election,$citizen)
    {
        $list = array();

        //prepare the statement
        $stmt = $this->db->conn->prepare("SELECT * FROM " .$this->table. " WHERE election = ? AND citizen = ?");
        $stmt->bind_param("ii", $election,$citizen);
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
