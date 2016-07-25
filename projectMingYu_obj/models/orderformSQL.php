<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class orderformSQL extends DB
    {
        function update($orderformID,$deadline,$totalPrice,$clientName)
        {
            $sql_update = "update `orderform`
                           inner join `client`
                           on `orderform`.`clientID`=`client`.`clientID`
                           set `orderform`.`orderformID`='".$orderformID."',`client`.`deadline`='".$deadline."',`orderform`.`total`='".$totalPrice."' 
                           where `client`.`clientName`='".$clientName."'";
            $row_update = $this -> connect($sql_update);
        }
        
        function insert_IDTotal($insertOrderformID,$insertTotal)
        {
            $sql_insert_IDTotal = "insert `orderform`(`orderformID`,`total`) 
                                   value('".$insertOrderformID."','".$insertTotal."')";
            $row_insert_IDTotal = $this -> connect($sql_insert_IDTotal);   
        }
        
        function update_clientID($plusClientID)
        {
            $sql_update_clientID = "update `orderform` 
                                    set `clientID`='".$plusClientID."' 
                                    where `clientID`=''";
            $row_update_clientID = $this -> connect($sql_update_clientID);   
        }
        
        function Delete($deleteOrderID)
        {
            $sql_delete = "delete from `orderform` 
                           where `orderform`.`orderformID` = '".$deleteOrderID."'";
            $row_delete = $this -> connect($sql_delete);
        }
    }
?>