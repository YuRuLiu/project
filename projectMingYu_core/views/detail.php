<!DOCTYPE html>
<html lang="zh-Hant-TW">
    <head>
        
        <title>明昱生命禮儀-訂單明細</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Bootstrap Core CSS -->
        <link href="/project/projectMingYu_core/views/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
        <!-- MetisMenu CSS -->
        <link href="/project/projectMingYu_core/views/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
        <!-- Custom CSS -->
        <link href="/project/projectMingYu_core/views/dist/css/sb-admin-2.css" rel="stylesheet">
    
        <!-- Custom Fonts -->
        <link href="/project/projectMingYu_core/views/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables CSS -->
        <link href="/project/projectMingYu_core/views/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="/project/projectMingYu_core/views/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="/project/projectMingYu_core/views/js/jquery.js"></script>
        <script src="/project/projectMingYu_core/views/js/bootstrap.js"></script>
    </head>
    
    <body>
        <!--------------公司名稱---------------->
        <div class="container-fluid">
            <div class="col-md-4 col-md-offset-5">
                <font size="7" face="微軟正黑體"><strong>明昱生命禮儀</strong></font>
            </div>
        </div>
        <!--------------功能列---------------->
        <div class="container-fluid col-md-offset-3">
            <div class="row">
                <form method="post" action="/project/projectMingYu_core/Login/logout">
                    <div class="col-md-3">
                        <h4><a href="/project/projectMingYu_core/Login/calendar">行事曆</a></h4>
                    </div>
                    <div class="col-md-3"><h4><a href="/project/projectMingYu_core/orderform/display_orderform">訂單列表</a></h4></div>
                    <div class="col-md-3"><h4>使用者身分：<?php echo $data11;?></h4></div>
                    <div class="col-md-3"><button type="submit" class="btn btn-link btn-lg" name="logout">登出</button></div>
                </form>
            </div>
        </div>
        <hr>
        <!--------------訂單明細---------------->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">訂單明細<br>
                                               訂單編號：<?php echo $data1;?><br>
                                               案名：<?php echo $data2;?><br>
                                               <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal">
                                                    新增明細
                                               </button> 
                    </div>
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <div class="row">
                                <div class="col-sm-6"></div>
                            </div>
                            <!--顯示明細列表-->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>編輯</th>
                                        <th>商品編號</th>
                                        <th>品名</th>
                                        <th>數量</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        /*顯示訂單明細資料*/   
                                        foreach($data3 as $show_paging){ ?>    
                                            <tr class="odd gradeX">
                                                <td>
                                                    <button type="button" class="btn-primary" data-toggle="modal" data-target="#myModal<?php echo $show_paging['productID'];?>">
                                                        修改
                                                    </button> 
                                                    <button type="button" class="btn-danger" data-toggle="modal" data-target="#deleteDetail<?php echo $show_paging['productID'];?>">
                                                        刪除
                                                    </button>     
                                                </td>
                                                <td><?php echo $show_paging['productID']?></td>
                                                <td><?php echo $show_paging['productName']?></td>
                                                <td><?php echo $show_paging['quantity']?></td>
                                            </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                        <!--明細總筆數-->    
                        <div class="col-sm-6">
                            <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">共 <?php echo $data4?> 筆</div>
                        </div>
                        <!--分頁-->
                        <div class="col-sm-1">
                            <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                <ul class="pagination">
                                    <?php 
                                        for($i=0;$i<$data9;$i++){
                                            if($i==$data10){?>    
                                                <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="/project/projectMingYu_core/detail/display_detail/<?php echo $data1 ?>/<?php echo $i ?>"><?php echo $i+1?></a></li>
                                            <?php }
                                            else{?>
                                                <li class="paginate_button" aria-controls="dataTables-example" tabindex="0"><a href="/project/projectMingYu_core/detail/display_detail/<?php echo $data1 ?>/<?php echo $i ?>"><?php echo $i+1?></a></li>
                                            <?php }
                                    }?>
                                    <input style="visibility:hidden" name="p" value="<?php echo $detailPage;?>"/>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <?php
            foreach($data5 as $show_update_modal){ ?>
            <!-- 修改明細的Modal -->
            <div class="modal fade" id="myModal<?php echo $show_update_modal['productID'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="/project/projectMingYu_core/detail/update">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">修改數量</h4>
                            </div>
                            <div class="modal-body">    
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>    
                                        <tr>
                                            <th>商品編號</th>
                                            <th>品名</th>
                                            <th>數量</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $show_update_modal['productID'];?></td>
                                            <td><?php echo $show_update_modal['productName'];?></td>
                                            <td>
                                                <!--<button type="submit" class="btn btn-default" aria-label="Left Align" name="plus_quantity">-->
                                                <!--    <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>-->
                                                <!--</button>-->
                                                <input type="text" name="update_quantity" value="<?php echo $show_update_modal['quantity'];?>"></input>
                                                <!--<button type="submit" class="btn btn-default" aria-label="Left Align" name="sub_quantity">-->
                                                <!--    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>-->
                                                <!--</button>    -->
                                            </td>
                                        </tr>    
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <input style="visibility:hidden" name="update_productID" value="<?php echo $show_update_modal['productID'];?>"/>
                                <input style="visibility:hidden" name="update_orderformID" value="<?php echo $show_update_modal['orderformID'];?>"/>
                                <button type="submit" class="btn btn-primary" name="updateDetailOK">儲存變更</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php }?>
        <?php 
            foreach($data6 as $show_delete_modal){ ?>
            <!-- 刪除明細的Modal -->
            <div class="modal fade bs-example-modal-sm" id="deleteDetail<?php echo $show_delete_modal['productID'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="/project/projectMingYu_core/detail/delete_detail">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">確定刪除此筆品項嗎？</h4>
                            </div>
                            <div class="modal-body">
                                商品編號：<?php echo $show_delete_modal['productID'];?><br>
                                品名：<?php echo $show_delete_modal['productName'];?><br>
                                數量：<?php echo $show_delete_modal['quantity'];?>
                            </div>
                            <div class="modal-footer">
                                <input style="visibility:hidden" name="delete_orderformID" value="<?php echo $data1;?>"/>
                                <input style="visibility:hidden" name="delete_productID" value="<?php echo $show_delete_modal['productID'];?>"/>
                                <button type="submit" class="btn btn-primary" name="deleteDetailOK">確定刪除</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php }?>
        <!-- 新增明細的Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" action="/project/projectMingYu_core/detail/insert">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">新增明細</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>    
                                        <tr>
                                            <th>品名</th>
                                            <th>數量</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data7 as $show_list){?>
                                        <tr>
                                            <td>    
                                                <input type="checkbox" value="<?php echo $show_list['productID'];?>" name="product[]"><?php echo $show_list['productName'];?>
                                            </td>
                                            <td>
                                                <input type="text" value="" name="insertQuantity[]">
                                            </td>    
                                        </tr> 
                                        <?php }?>
                                    </tbody>
                                </table>
                        </div>
                        <div class="modal-footer">
                            <input style="visibility:hidden" name="insert_orderformID" value="<?php echo $data1;?>"/>
                            <input style="visibility:hidden" name="insert_clientID" value="<?php echo $data8;?>"/>
                            <button type="submit" class="btn btn-primary" name="insertDetailOK">確定新增</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>