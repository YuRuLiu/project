<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");  
    
    class productShow extends selectRow
    {
        function content()
        {
            $sql_content = "select `productID`,`productName` 
                            from `product` 
                            where `placeID`='2'";
            $row_content = $this -> select($sql_content);
            return $row_content;
        }
    }
?>