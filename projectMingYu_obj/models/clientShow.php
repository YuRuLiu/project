<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");  
    
    class clientShow extends selectRow
    {
        function select_clientID()
        {
            $sql_select_clientID = "select `clientID` 
                                    from `client` 
                                    order by `clientID` desc 
                                    limit 1";
            $row_select_clientID = $this -> select($sql_select_clientID);
            return $row_select_clientID;
        }
    }
?>