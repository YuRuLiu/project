<?php 
    
    class orderformController extends Controller
    {
        function display_orderform($orderpage="")
        {
            $pagesize = 10; 
            if ($orderpage == "")
                $orderpage = 0;
                
            /*--顯示分頁於table--*/
            $paging = $this -> model("orderformSelect");
            $display_orderform = $paging -> paging($orderpage,$pagesize);
            
            /*--顯示總筆數--*/
            $compute_paging = $this -> model("orderformSelect");
            $show_total = $compute_paging ->content(); 
            $total = count($show_total); //取得資料的總筆數
            $totalpages = ceil($total/ $pagesize);   //總頁數
            
            /*--顯示此筆訂單內容於update modal--*/
            $update_modal = $this -> model("orderformSelect");
            $show_update_modal = $update_modal -> content();
            
            /*--顯示此筆訂單內容於delete modal--*/
            $delete_modal = $this -> model("orderformSelect");
            $show_delete_modal = $delete_modal -> content();
            
            $session = $this -> model("check_log");
            $session -> defence();
            
            $name = $this -> model("check_log");
            $session_name = $name -> name();
            
            $this -> view("orderform",$display_orderform,$total,$show_update_modal,$show_delete_modal,
                                      $totalpages,$orderpage,$session_name);
        }
        
        function update()
        {
            $updateOrderform = $_POST["updateOrderform"];
            $update_orderformID = $_POST["update_orderformID"];
            $update_clientName = $_POST["update_clientName"];
            $update_deadline = $_POST["update_deadline"];
            $update_total = $_POST["update_total"];
            
            if(isset ($updateOrderform))
            {         
                $update = $this -> model("orderformSQL");
                $update -> update($update_orderformID,$update_deadline,$update_total,$update_clientName);
                
                $url = '/project/projectMingYu_core/orderform/display_orderform/'.$orderpage; 
                header("refresh: 1;url='$url'"); 
            }
        }
        
        function insert()
        {
            $insertOrderform = $_POST["insertOrderform"];
            $insert_orderformID = $_POST["insert_orderformID"];
            $insert_clientName = $_POST["insert_clientName"];
            $insert_deadline = $_POST["insert_deadline"];
            $insert_total = $_POST["insert_total"];
    
            if(isset ($insertOrderform))
            {         
                $insert_IDTotal = $this -> model("orderformSQL");
                $insert_IDTotal -> insert_IDTotal($insert_orderformID,$insert_total);
                
                $insert_NameDeadline = $this -> model("clientSQL");
                $insert_NameDeadline -> insert_NameDeadline($insert_clientName,$insert_deadline);
                
                $plusClientID = $this -> increment_clientID();
                
                $update_client_clientID = $this -> model("clientSQL");
                $update_client_clientID -> update_clientID($plusClientID);
                
                $update_orderform_clientID = $this -> model("orderformSQL");
                $update_orderform_clientID -> update_clientID($plusClientID);
                
                $url = '/project/projectMingYu_core/orderform/display_orderform/'.$orderpage; 
                header("refresh: 1;url='$url'"); 
            }
        }
        
        function delete_orderform()
        {
            $deleteOrderform = $_POST["deleteOrderform"];
            $delete_orderformID = $_POST["delete_orderformID"];  
            
            if(isset($deleteOrderform))
            {
                $delete_client = $this -> model("clientSQL");
                $delete_client -> Delete($delete_orderformID);
                
                $delete_orderform = $this -> model("orderformSQL");
                $delete_orderform -> Delete($delete_orderformID);
                
                $delete_detail = $this -> model("detailSQL");
                $delete_detail -> order_delete_detail($delete_orderformID);
                
                $url = '/project/projectMingYu_core/orderform/display_orderform/'.$orderpage; 
                header("refresh: 1;url='$url'"); 
            }
        }
        
        function increment_clientID() //增加clientID
        {
            $select_clientID = $this -> model("clientSelect");
            $clientID = $select_clientID -> select_clientID();
            $plusClientID = $clientID[0]['clientID'] + 1;
            $plusClientID = str_pad($plusClientID,6,'0',STR_PAD_LEFT);
            return $plusClientID;
        }
    }
?>