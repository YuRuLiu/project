<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");
    
    class orderformSelect extends selectRow
    {
        function content()
        {
            $sql_content = "SELECT `orderform`.`orderformID`,`client`.`clientName`,`client`.`deadline`,`orderform`.`total` 
                            FROM `orderform`
                            INNER JOIN `client`
                            ON `orderform`.`clientID`=`client`.`clientID`";
            $row_content = $this -> select($sql_content);
            return $row_content;
        }
        
        function paging($orderpage,$pagesize)
        {
            $sql_paging = "SELECT `orderform`.`orderformID`,`client`.`clientName`,`client`.`deadline`,`orderform`.`total` 
                           FROM `orderform`
                           INNER JOIN `client`
                           ON `orderform`.`clientID`=`client`.`clientID`
                           LIMIT ".$orderpage*$pagesize.",".$pagesize."";
            $row_paging = $this -> select($sql_paging);
            return $row_paging;
        }
        
        function select_clientName($orderform)
        {
            $sql_select_clientName = "SELECT `client`.`clientID`,`client`.`clientName` 
                                      FROM `orderform`
                                      INNER JOIN `client`
                                      ON `orderform`.`clientID`=`client`.`clientID`
                                      WHERE `orderformID`='".$orderform."'";
            $row_select_clientName = $this -> select($sql_select_clientName);
            return $row_select_clientName;
        }
    }
        
?>