<?php
session_start();
include_once("config.php");

$_SESSION['sname'] = $_POST['storeName'];

header('Location: main.php');
    exit;
   
 ?>