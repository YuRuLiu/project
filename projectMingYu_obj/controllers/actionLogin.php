<?php 
    session_start();
    header("content-type:text/html;chaset=utf-8");
    include_once("../models/user.php");
    //$userName = addslashes($_POST["userName"]);
    //$userPW = addslashes($_POST["userPW"]);
    $userName = $_POST["userName"];
    $userPW = $_POST["userPW"];
    $btnlogin = $_POST["btnlogin"];
    $btnlogout = $_POST["logout"];
    
    if(isset ($btnlogin))
    {
        $r = new user();
        $row = $r->selectUser($userName);
        if($userName == $row[0]['userName'] && $userPW ==$row[0]['userPW'])
        {
            $_SESSION['userName'] = $userName;
            header("location:../views/indexx.php"); 
        }
        else
            header("location:../views/LoginFail.php");
    }
    
    if(isset($btnlogout))
    {
        unset($_SESSION['userName']);
        header("location:../views/Logout.php");
    }
?>