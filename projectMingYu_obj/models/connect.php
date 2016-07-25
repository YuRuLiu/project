<?php
    class DB
    {
        protected $result;
        function connect($com)
        {
            $dbhost = "127.0.0.1";
            $dbuser = "root";
            $dbpass = "";
            $dbname = "mingyu";
            
            //使用PDO存取資料庫時，需要將資料庫依下列格式撰寫，讓程式讀取資料庫
            $dbconnect = "mysql:host=".$dbhost.";dbname=".$dbname;
            //建立使用PDO方式連線的物件，並放入指定的相關資料
            $dbgo = new PDO($dbconnect, $dbuser, $dbpass);
            $dbgo->query('SET NAMES UTF8');
            $this->result = $dbgo->query($com);
            
            $dbgo = NULL;//斷線
        }
    }
?>