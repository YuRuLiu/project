<?php

    class detailController extends Controller
    {
        function display_detail($orderform,$detailPage="")
        {
            $pagesize=10;
            if ($detailPage=="")
                $detailPage=0;
            
            /*--顯示案名--*/
            $select_clientName = $this -> model("orderformSelect");
            $clientName = $select_clientName -> select_clientName($orderform);
            
            /*--顯示分頁於table--*/
            $paging = $this -> model("detailSelect");
            $show_paging = $paging -> paging($orderform,$detailPage,$pagesize);
            
            /*--顯示總筆數--*/
            $compute_paging = $this -> model("detailSelect");
            $show_total = $compute_paging -> content($orderform);
            $total = count($show_total); //取得資料的總數
            $totalpages= ceil($total/ $pagesize);   //總頁數
            
            /*--顯示此筆明細於update modal--*/
            $update_modal = $this -> model("detailSelect");
            $show_update_modal = $update_modal -> content($orderform);
            
            /*--顯示此筆明細於delete modal--*/
            $delete_modal = $this -> model("detailSelect");
            $show_delete_modal = $delete_modal -> content($orderform);
            
            /*--顯示商品清單於insert modal--*/
            $select_product = $this -> model("productSelect");
            $show_list = $select_product -> content();
            
            $session = $this -> model("check_log");
            $session -> defence();
            
            $name = $this -> model("check_log");
            $session_name = $name -> name();
            
            $this -> view("detail",$orderform,$clientName[0]['clientName'],$show_paging,$total,
                                   $show_update_modal,$show_delete_modal,$show_list,$clientName[0]['clientID'],
                                   $totalpages,$detailPage,$session_name);
        }
        
        function insert()
        {
            /*--新增明細POST的值--*/
            $insertDetailOK=$_POST["insertDetailOK"];
            $product = $_POST ["product"];
            $insertQuantity = $_POST["insertQuantity"];
            $insert_orderformID = $_POST["insert_orderformID"];
            $insert_clientID = $_POST["insert_clientID"];
    
            /*--新增明細--*/
            $quantityNotNull = @array_filter($insertQuantity); //將空值濾掉，保留有值的元素
            $insertDetail = @array_combine($product, $quantityNotNull); //結合2個陣列，2個陣列元素的數量須相同
            
            if(isset($insertDetailOK))
            {
                foreach ($insertDetail as $key => $value)
                {    
                    $insert = $this -> model("detailSQL");
                    $insert -> insert($insert_orderformID,$key,$value,$insert_clientID);
                }
                
                $url = '/project/projectMingYu_core/detail/display_detail/'.$insert_orderformID; 
                header("refresh: 1;url='$url'"); 
            }
        }
        
        function update()
        {
            /*--修改明細POST的值--*/
            $updateDetailOK = $_POST["updateDetailOK"];
            $update_quantity = $_POST["update_quantity"];
            $update_productID = $_POST["update_productID"];
            $update_orderformID = $_POST["update_orderformID"];
            $page = $_POST["p"];
            $plus_quantity = $_POST["plus_quantity"];
            
            /*--修改明細數量--*/
            if(isset ($updateDetailOK))
            {
                $update = $this -> model("detailSQL");
                $update -> update($update_quantity,$update_productID);
                
                $url = '/project/projectMingYu_core/detail/display_detail/'.$update_orderformID; 
                header("refresh: 1;url='$url'");
            }
        }
        
        function delete_detail()
        {
            /*--刪除明細POST的值--*/
            $deleteDetailOK = $_POST["deleteDetailOK"];
            $delete_productID = $_POST["delete_productID"];
            $delete_orderformID = $_POST["delete_orderformID"];
            
            if(isset($deleteDetailOK))
            {
                $delete = $this -> model("detailSQL");
                $delete -> Delete($delete_orderformID,$delete_productID);
                
                $url = '/project/projectMingYu_core/detail/display_detail/'.$delete_orderformID; 
                header("refresh: 1;url='$url'");
            }
        }
    }

?>