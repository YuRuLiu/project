<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class detailSQL extends DB
    {
        function update($quantity,$productID)
        {
            $sql_update = "UPDATE `detail` 
                           SET `quantity`='".$quantity."'
                           WHERE `productID`='".$productID."'";
            $row_update = $this -> connect($sql_update);
        }
        
        function insert($orderID,$key,$value,$clientID)
        {
            $sql_insert = "INSERT INTO `detail`
                           (`orderformID`,`productID`,`quantity`,`clientID`)
                           VALUES('".$orderID."','".$key."','".$value."','".$clientID."')";
            $row_insert = $this -> connect($sql_insert);
        }
        
        function Delete($deleteOrderformID,$deleteProductID)
        {
            $sql_delete = "DELETE FROM `detail` 
                           WHERE `orderformID` = '".$deleteOrderformID."' AND `productID` = '$deleteProductID'";
            $row_delete = $this -> connect($sql_delete);
        }
        
        function order_delete_detail($deleteOrderID)
        {
            $sql_order_delete_detail = "DELETE FROM `detail` 
                                        WHERE `orderformID` = '".$deleteOrderID."'";
            $row_order_delete_detail = $this -> connect($sql_order_delete_detail);
        }
    }
?>