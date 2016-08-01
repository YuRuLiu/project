<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");  
    
    class productSelect extends selectRow
    {
        function content()
        {
            $sql_content = "SELECT `productID`,`productName` 
                            FROM `product` 
                            WHERE `placeID`='2'";
            $row_content = $this -> select($sql_content);
            return $row_content;
        }
    }
?>