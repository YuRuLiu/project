<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");
    
    class detailShow extends selectRow
    {
        function content($orderform)
        {
            $sql_content = "select `detail`.`productID`,`product`.`productName`,`detail`.`quantity`,`detail`.`orderformID` 
                            from `detail` 
                            inner join  `product`
                            on `detail`.`productID` = `product`.`productID`
                            where `detail`.`orderformID`= '".$orderform."'";
            $row_content = $this -> select($sql_content);
            return $row_content;
        }
        
        function paging($orderform,$p,$pagesize)
        {
            $sql_paging = "select `detail`.`productID`,`product`.`productName`,`detail`.`quantity` 
                           from `detail` 
                           inner join  `product`
                           on `detail`.`productID` = `product`.`productID`
                           where `detail`.`orderformID`= '".$orderform."'
                           limit ".($p * $pagesize).", ".$pagesize."";
            $row_paging = $this -> select($sql_paging);
            return $row_paging;
        }    
    }