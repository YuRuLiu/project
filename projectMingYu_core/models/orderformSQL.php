<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class orderformSQL extends DB
    {
        function update($orderformID,$deadline,$totalPrice,$clientName)
        {
            $sql_update = "UPDATE `orderform`
                           INNER JOIN `client`
                           ON `orderform`.`clientID`=`client`.`clientID`
                           SET `orderform`.`orderformID`='".$orderformID."',`client`.`deadline`='".$deadline."',`orderform`.`total`='".$totalPrice."' 
                           WHERE `client`.`clientName`='".$clientName."'";
            $row_update = $this -> connect($sql_update);
        }
        
        function insert_IDTotal($insertOrderformID,$insertTotal)
        {
            $sql_insert_IDTotal = "INSERT `orderform`(`orderformID`,`total`) 
                                   VALUES('".$insertOrderformID."','".$insertTotal."')";
            $row_insert_IDTotal = $this -> connect($sql_insert_IDTotal);   
        }
        
        function update_clientID($plusClientID)
        {
            $sql_update_clientID = "UPDATE `orderform` 
                                    SET `clientID`='".$plusClientID."' 
                                    WHERE `clientID`=''";
            $row_update_clientID = $this -> connect($sql_update_clientID);   
        }
        
        function Delete($deleteOrderID)
        {
            $sql_delete = "DELETE FROM `orderform` 
                           WHERE `orderform`.`orderformID` = '".$deleteOrderID."'";
            $row_delete = $this -> connect($sql_delete);
        }
    }
?>