<?php
    include("../../asset/connect.php");
    session_start();
    if(!isset($_SESSION['use']) || !$_SESSION['adm']){
      header('location:../../');
      }
?>