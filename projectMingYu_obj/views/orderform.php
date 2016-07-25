<?php 
    include("../controllers/actionOrderform.php");
?>
<!DOCTYPE html>
<html lang="zh-Hant-TW">
    <head>
        
        <title>明昱生命禮儀-訂單列表</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Bootstrap Core CSS -->
        <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
        <!-- MetisMenu CSS -->
        <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    
        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    
        <!-- Custom Fonts -->
        <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- DataTables CSS -->
        <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </head>
    
    <body>
        <!--------------公司名稱---------------->
        <div class="col-md-4 col-md-offset-5">
            <font size="7" face="微軟正黑體"><strong>明昱生命禮儀</strong></font>
        </div>
        <!--------------功能列---------------->
        <div class="row"> 
            <form method="post" action="../controllers/actionLogin.php">
                <div class="col-md-2 col-md-offset-3"><h4><a href="indexx.php">行事曆</a></h4></div>
                <div class="col-md-2 col-md-offset-3"><h4>使用者身分：<?php echo $_SESSION['userName'];?></h4></div>
                <div class="col-md-2"><button type="submit" class="btn btn-link btn-lg" name="logout">登出</button></div>
            </form>
        </div>
        <hr>
        <!--------------訂單列表---------------->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">訂單列表</div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <div class="row">
                                <div class="col-sm-4">
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#insertOrderform">
                                        新增訂單
                                    </button>
                                </div>
                            </div>
                            <!--顯示訂單列表-->
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <!--訂單欄位-->
                                <thead>
                                    <tr>
                                        <th>編輯</th>
                                        <th>訂單編號</th>
                                        <th>案名</th>
                                        <th>出殯日期</th>
                                        <th>總金額</th>
                                    </tr>
                                </thead>
                                <!--欄位內容-->
                                <tbody>
                                    <?php
                                        for($n=0;$n<$page;$n++){ ?>
                                        <tr class="odd gradeX">
                                            <td>
                                                <button type="button" class="btn-primary" data-toggle="modal" data-target="#orderformModal<?php echo $show_paging[$n]['orderformID'];?>">
                                                    修改
                                                </button>  
                                                <button type="button" class="btn-danger" data-toggle="modal" data-target="#deleteOrderform<?php echo $show_paging[$n]['orderformID'];?>">
                                                    刪除
                                                </button> 
                                            </td>
                                            <td><a href="detail.php?orderform=<?php echo $show_paging[$n]['orderformID']?>"><?php echo $show_paging[$n]['orderformID']?></a></td>
                                            <td><?php echo $show_paging[$n]['clientName']?></td>
                                            <td><?php echo $show_paging[$n]['deadline']?></td>
                                            <td><?php echo $show_paging[$n]['total']?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!--訂單總筆數-->
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status" aria-live="polite">共 <?php echo $total?> 筆</div>
                            </div>
                            <!--分頁-->
                            <div class="col-sm-4">
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                    <ul class="pagination">
                                        <!--<li class="paginate_button previous disabled" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_previous"><a href="#">Previous</a></li>-->
                                        <?php 
                                            for($i=0;$i<$totalpages;$i++){
                                                if($i==$orderpage){?>    
                                                    <li class="paginate_button active" aria-controls="dataTables-example" tabindex="0"><a href="orderform.php?orderpage=<?php echo $i ?>"><?php echo $i+1?></a></li>
                                                <?php }
                                                else{?>
                                                    <li class="paginate_button" aria-controls="dataTables-example" tabindex="0"><a href="orderform.php?orderpage=<?php echo $i ?>"><?php echo $i+1?></a></li>
                                                <?php }
                                        }?>
                                        <!--<li class="paginate_button next" aria-controls="dataTables-example" tabindex="0" id="dataTables-example_next"><a href="#">Next</a></li>-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            for($j=0;$j<$show_update;$j++){ ?>
            <!-- 修改訂單的Modal -->
            <div class="modal fade" id="orderformModal<?php echo $show_update_modal[$j]['orderformID'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form method="post" action="../controllers/actionOrderform.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">修改訂單</h4>
                            </div>
                            <div class="modal-body">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>    
                                        <tr>
                                            <th>訂單編號</th>
                                            <th>案名</th>
                                            <th>出殯日期</th>
                                            <th>總金額</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <input style="visibility:hidden" name="update_orderformID" value="<?php echo $show_update_modal[$j]['orderformID'];?>"/>
                                            <input style="visibility:hidden" name="update_clientName" value="<?php echo $show_update_modal[$j]['clientName'];?>"/>
                                            <td><?php echo $show_update_modal[$j]['orderformID'];?></td>
                                            <td><?php echo $show_update_modal[$j]['clientName'];?></td>
                                            <td>
                                                <input type="text" name="update_deadline" value="<?php echo $show_update_modal[$j]['deadline'];?>"></input>
                                            </td>
                                            <td>
                                                <input type="text" name="update_total" value="<?php echo $show_update_modal[$j]['total'];?>"></input>
                                            </td>
                                        </tr>    
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="updateOrderform" value="儲存變更" />
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        <?php }?>
        <?php 
            for($k=0;$k<$show_delete;$k++){ ?>
            <!-- 刪除訂單的Modal -->
            <div class="modal fade bs-example-modal-sm" id="deleteOrderform<?php echo $show_delete_modal[$k]['orderformID'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="post" action="../controllers/actionOrderform.php">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">確定刪除此筆訂單嗎？</h4>
                            </div>
                            <div class="modal-body">
                                訂單編號：<?php echo $show_delete_modal[$k]['orderformID'];?><br>
                                案名：<?php echo $show_delete_modal[$k]['clientName'];?>
                            </div>
                            <div class="modal-footer">    
                                <input style="visibility:hidden" name="delete_orderformID" value="<?php echo $show_delete_modal[$k]['orderformID'];?>"/>
                                <button type="submit" class="btn btn-primary" name="deleteOrderform">確定刪除</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php }?>
        <!-- 新增訂單的Modal -->
        <div class="modal fade" id="insertOrderform" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form method="post" action="../controllers/actionOrderform.php">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">新增訂單</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>    
                                    <tr>
                                        <th>訂單編號</th>
                                        <th>案名</th>
                                        <th>出殯日期</th>
                                        <th>總金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="insert_orderformID" value=""></input>
                                        </td>
                                        <td>
                                            <input type="text" name="insert_clientName" value=""></input>
                                        </td>
                                        <td>
                                            <input type="text" name="insert_deadline" value=""></input>
                                        </td>
                                        <td>
                                            <input type="text" name="insert_total" value=""></input>
                                        </td>
                                    </tr>    
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" name="insertOrderform" value="確定新增" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </body>
</html>