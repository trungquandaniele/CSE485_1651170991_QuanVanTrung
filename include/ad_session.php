<?php
    include("../../asset/connect.php");
    session_start();
    if(!isset($_SESSION['use']) || !$_SESSION['adm']){
      header('location:/CSE485_1651170912_NguyenThanhGiang-1/');
      }
?>