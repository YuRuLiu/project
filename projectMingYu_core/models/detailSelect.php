<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");
    
    class detailSelect extends selectRow
    {
        function content($orderform)
        {
            $sql_content = "SELECT `detail`.`productID`,`product`.`productName`,`detail`.`quantity`,`detail`.`orderformID` 
                            FROM `detail` 
                            INNER JOIN  `product`
                            ON `detail`.`productID` = `product`.`productID`
                            WHERE `detail`.`orderformID`= '".$orderform."'";
            $row_content = $this -> select($sql_content);
            return $row_content;
        }
        
        function paging($orderform,$p,$pagesize)
        {
            $sql_paging = "SELECT `detail`.`productID`,`product`.`productName`,`detail`.`quantity` 
                           FROM `detail` 
                           INNER JOIN  `product`
                           ON `detail`.`productID` = `product`.`productID`
                           WHERE `detail`.`orderformID`= '".$orderform."'
                           LIMIT ".($p * $pagesize).", ".$pagesize."";
            $row_paging = $this -> select($sql_paging);
            return $row_paging;
        }    
    }