<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");  
    
    class clientSelect extends selectRow
    {
        function select_clientID()
        {
            $sql_select_clientID = "SELECT `clientID` 
                                    FROM `client` 
                                    ORDER BY `clientID` DESC 
                                    LIMIT 1";
            $row_select_clientID = $this -> select($sql_select_clientID);
            return $row_select_clientID;
        }
    }
?>