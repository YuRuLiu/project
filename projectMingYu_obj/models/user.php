<?php 
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");
    
    class user extends selectRow
    {
        function selectUser($userName)
        {
            $sql = "SELECT `userName`,`userPW` 
                    FROM `employee` 
                    where userName='$userName'";
            $row = $this -> select($sql);
            return $row;
        }
    }
?>