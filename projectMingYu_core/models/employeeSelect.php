<?php 
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");
    
    class employeeSelect extends selectRow
    {
        function selectUser($userName)
        {
            $sql = "SELECT `userName`,`userPW` 
                    FROM `employee` 
                    WHERE userName='$userName'";
            $row = $this -> select($sql);
            return $row;
        }
    }
?>
    