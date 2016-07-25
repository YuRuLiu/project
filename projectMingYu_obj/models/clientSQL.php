<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class clientSQL extends DB
    {
        function insert_NameDeadline($insertClientName,$insertDeadline)
        {
            $sql_insert_NameDeadline = "insert `client`(`clientName`,`deadline`) 
                                        value('".$insertClientName."','".$insertDeadline."')";
            $row_insert_NameDeadline = $this -> connect($sql_insert_NameDeadline);   
        }
        
        function update_clientID($plusClientID)
        {
            $sql_update_clientID = "update `client` 
                                    set `clientID`='".$plusClientID."' 
                                    where `clientID`=''";
            $row_update_clientID = $this -> connect($sql_update_clientID);
        }
        
        function Delete($deleteOrderID)
        {
            $sql_delete = "delete `client` from `client` 
                           inner join `orderform`
                           on `client`.`clientID`=`orderform`.`clientID`
                           where `orderformID` = '".$deleteOrderID."'";                    
            $row_delete = $this -> connect($sql_delete);
        }
    }
?>    