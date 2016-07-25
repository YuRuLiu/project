<?php
    require_once("connect.php");
    header("content-type:text/html;chaset=utf-8");
    
    class detailSQL extends DB
    {
        function update($quantity,$productID)
        {
            $sql_update = "update `detail` 
                           set `quantity`='".$quantity."'
                           where `productID`='".$productID."'";
            $row_update = $this -> connect($sql_update);
        }
        
        function insert($orderID,$key,$value,$clientID)
        {
            $sql_insert = "insert into `detail`
                           (`orderformID`,`productID`,`quantity`,`clientID`)
                           values('".$orderID."','".$key."','".$value."','".$clientID."')";
            $row_insert = $this -> connect($sql_insert);
        }
        
        function Delete($deleteOrderformID,$deleteProductID)
        {
            $sql_delete = "delete from `detail` 
                           where `orderformID` = '".$deleteOrderformID."' AND `productID` = '$deleteProductID'";
            $row_delete = $this -> connect($sql_delete);
        }
        
        function order_delete_detail($deleteOrderID)
        {
            $sql_order_delete_detail = "delete from `detail` 
                                       where `orderformID` = '".$deleteOrderID."'";
            $row_order_delete_detail = $this -> connect($sql_order_delete_detail);
        }
    }
?>