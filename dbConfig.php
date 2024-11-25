<?php
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=php_master;charset=utf8;host=localhost', 'root', ''); ローカルよう
    
  } catch (PDOException $e) {
    exit('DbConnectError:' . $e->getMessage());
  }
?>