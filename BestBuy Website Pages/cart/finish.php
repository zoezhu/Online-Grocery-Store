<?php
session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View shopping cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css"><link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/w3-theme-black.css">
<link rel="stylesheet" href="../css/Roboto.css">
<link rel="stylesheet" href="../css/font-awesome.min.css"></head>
<body>
<div class="w3-main w3-padding-64 w3-container">
 
<h1 class="w3-text-teal" align="left" style="margin:2px">Order Submitted</h1>
<br/>
Thank you for your order. Your groceries will be delivered soon to your door.
<p>
<a href="../customer_transaction.php" class="button">View Transactions</a></p>
</body>
</div>
</html>
