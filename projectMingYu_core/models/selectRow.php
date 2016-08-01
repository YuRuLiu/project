<?php 
    require_once("connect.php");
    
    class selectRow extends DB
    {
        function select($com)
        {
            $this->connect($com);
            $result2 = $this->result;
            $row = $result2->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }
?>
    