<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class clientSQL extends DB
    {
        function insert_NameDeadline($insertClientName,$insertDeadline)
        {
            $sql_insert_NameDeadline = "INSERT `client`(`clientName`,`deadline`) 
                                        VALUES('".$insertClientName."','".$insertDeadline."')";
            $row_insert_NameDeadline = $this -> connect($sql_insert_NameDeadline);   
        }
        
        function update_clientID($plusClientID)
        {
            $sql_update_clientID = "UPDATE `client` 
                                    SET `clientID`='".$plusClientID."' 
                                    WHERE `clientID`=''";
            $row_update_clientID = $this -> connect($sql_update_clientID);
        }
        
        function Delete($deleteOrderID)
        {
            $sql_delete = "DELETE `client` FROM `client` 
                           INNER JOIN `orderform`
                           ON `client`.`clientID`=`orderform`.`clientID`
                           WHERE `orderformID` = '".$deleteOrderID."'";                    
            $row_delete = $this -> connect($sql_delete);
        }
    }
?>    