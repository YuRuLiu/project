<?php
    require_once("employeeSelect.php");
    session_start();
    
    class check_log 
    {
        function check_user($btnlogin,$userName,$userPW)
        {
            if(isset ($btnlogin))
            {
                $employee = new employeeSelect();
                $uesrName_PW = $employee -> selectUser($userName);
    
                if($userName == $uesrName_PW[0]['userName'] && $userPW ==$uesrName_PW[0]['userPW'])
                {
                    $_SESSION['userName'] = $userName;
                    
                    return "calendar"; 
                }
                else
                    return "LoginFail";
            }
        }
        
        function logout($btnlogout)
        {
            if(isset($btnlogout))
            {
                unset($_SESSION['userName']);
                return "Logout";
            }
        }
        
        function defence()
        {
            if($_SESSION['userName'] == NULL)
                header("location:/project/projectMingYu_core/Login");   
        }
        
        function name()
        {
            $name = $_SESSION['userName'];
            return $name; 
        }
    }
?>