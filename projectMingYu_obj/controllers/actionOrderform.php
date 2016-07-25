<?php
    session_start();
    header("content-type:text/html;charset=utf-8");
    include("../models/orderformSQL.php");
    include("../models/orderformShow.php");
    include("../models/clientSQL.php");
    include("../models/clientShow.php");
    include("../models/detailSQL.php");
    
    if($_SESSION['userName'] == NULL)
        header("location:../views/Login.php");
    
    /*--修改訂單POST的值--*/
    $updateOrderform = $_POST["updateOrderform"];
    $update_orderformID = $_POST["update_orderformID"];
    $update_clientName = $_POST["update_clientName"];
    $update_deadline = $_POST["update_deadline"];
    $update_total = $_POST["update_total"];
    
    /*--新增訂單POST的值--*/
    $insertOrderform = $_POST["insertOrderform"];
    $insert_orderformID = $_POST["insert_orderformID"];
    $insert_clientName = $_POST["insert_clientName"];
    $insert_deadline = $_POST["insert_deadline"];
    $insert_total = $_POST["insert_total"];
    
    /*--刪除訂單POST的值--*/
    $deleteOrderform = $_POST["deleteOrderform"];
    $delete_orderformID = $_POST["delete_orderformID"];
    
    /*--計算分頁--*/
    $compute_paging = new orderformShow();
    $show_total = $compute_paging ->content(); 
    $total = count($show_total); //取得資料的總筆數
    $pagesize = 10;                           //單頁筆數
    $totalpages = ceil($total/ $pagesize);   //總頁數
    $orderpage = $_GET['orderpage'];
    if ($orderpage == "")
        $orderpage = 0;

    /*--顯示分頁於table--*/
    $paging = new orderformShow();
    $show_paging = $paging->paging($orderpage,$pagesize);
    $page = count($show_paging);
    
    /*--顯示此筆訂單內容於update modal--*/
    $update_modal = new orderformShow();
    $show_update_modal = $update_modal->content();
    $show_update = count($show_update_modal);
    
    /*--顯示此筆訂單內容於delete modal--*/
    $delete_modal = new orderformShow();
    $show_delete_modal = $delete_modal -> content();
    $show_delete = count($show_delete_modal);
    
    /*--修改訂單--*/
    if(isset ($updateOrderform))
    {         
        $update = new orderformSQL();
        $update -> update($update_orderformID,$update_deadline,$update_total,$update_clientName);
        
        refresh_orderform();
    }
    
    /*--新增訂單--*/
    if(isset ($insertOrderform))
    {         
        $insert_IDTotal = new orderformSQL();
        $insert_IDTotal -> insert_IDTotal($insert_orderformID,$insert_total);
        
        $insert_NameDeadline = new clientSQL();
        $insert_NameDeadline -> insert_NameDeadline($insert_clientName,$insert_deadline);
        
        $plusClientID = increment_clientID();
        
        $update_client_clientID = new clientSQL();
        $update_client_clientID -> update_clientID($plusClientID);
        
        $update_orderform_clientID = new orderformSQL();
        $update_orderform_clientID -> update_clientID($plusClientID);
        
        refresh_orderform();
    }
    
    /*--刪除訂單--*/
    if(isset($deleteOrderform))
    {
        $delete_client = new clientSQL();
        $delete_client -> Delete($delete_orderformID);
        
        $delete_orderform = new orderformSQL();
        $delete_orderform -> Delete($delete_orderformID);
        
        $delete_detail = new detailSQL();
        $delete_detail -> order_delete_detail($delete_orderformID);
        
        refresh_orderform();
    }
    
    /*--增加clientID--*/
    function increment_clientID()
    {
        $select_clientID = new clientShow();
        $clientID = $select_clientID -> select_clientID();
        $plusClientID = $clientID[0]['clientID'] + 1;
        $plusClientID = str_pad($plusClientID,6,'0',STR_PAD_LEFT);
        return $plusClientID;
    }
    
    /*--刷新頁面--*/
    function refresh_orderform()
    {
        $url = '../views/orderform.php?p='.$orderpage; 
        header("refresh: 1;url='$url'"); 
    }
?>