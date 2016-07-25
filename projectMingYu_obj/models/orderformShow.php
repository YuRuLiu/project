<?php
    require_once("selectRow.php");
    header("content-type:text/html;chaset=utf-8");
    
    class orderformShow extends selectRow
    {
        function content()
        {
            $sql_content = "select `orderform`.`orderformID`,`client`.`clientName`,`client`.`deadline`,`orderform`.`total` 
                            from `orderform`
                            inner join `client`
                            on `orderform`.`clientID`=`client`.`clientID`";
            $row_content = $this -> select($sql_content);
            return $row_content;
        }
        
        function paging($orderpage,$pagesize)
        {
            $sql_paging = "select `orderform`.`orderformID`,`client`.`clientName`,`client`.`deadline`,`orderform`.`total` 
                           from `orderform`
                           inner join `client`
                           on `orderform`.`clientID`=`client`.`clientID`
                           limit ".$orderpage*$pagesize.",".$pagesize."";
            $row_paging = $this -> select($sql_paging);
            return $row_paging;
        }
        
        function select_clientName($orderform)
        {
            $sql_select_clientName = "select `client`.`clientID`,`client`.`clientName` 
                                      from `orderform`
                                      inner join `client`
                                      on `orderform`.`clientID`=`client`.`clientID`
                                      where `orderformID`='".$orderform."'";
            $row_select_clientName = $this -> select($sql_select_clientName);
            return $row_select_clientName;
        }
    }
        
?>