<!DOCTYPE html>
<?php
session_start();
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme-black.css">
<link rel="stylesheet" href="css/Roboto.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {padding: 12px;}
.w3-navbar li a {
    padding-top: 12px;
    padding-bottom: 12px;
}
</style>
<body>
    
    
<!-- Navbar -->
<div class="w3-top">
  <ul class="w3-navbar w3-theme w3-top w3-large">
    
    
    <li><a class="w3-theme-l1" style="width:250px">Great E-Business Store</a></li>
    <?php
    print "<li><a class=\"w3-theme-d1 w3-left-align\" style=\"width:350px\">Hello, {$_SESSION['username']}</a></li>";
    ?>
    
    <li class="w3-hide-small w3-center"><a href="main.php" target="main" class="w3-hover-white" style="width:100px">Home</a></li>
    <li class="w3-hide-small w3-center"><a href="account_view.php" target="main" class="w3-hover-white" style="width:100px">Account</a></li>
    <li class="w3-hide-small w3-center"><a href="cart/view_cart.php" target="main" class="w3-hover-white" style="width:100px">Cart</a></li>
      
      <?php 
      if($_SESSION['userType']=='admin'){
         print "<li class=\"w3-hide-small w3-center\"><a href=\"adminFrame.html\" target=\"_parent\" class=\"w3-hover-white\" style=\"width:150px\">Admin Page</a></li>"; 
      }
      else{
         print "<li class=\"w3-hide-small w3-center\"><a href=\"customer_transaction.php\" target=\"main\" class=\"w3-hover-white\" style=\"width:120px\">Transaction</a></li>"; 
      }
      ?>
      
<!--    <li><a class="w3-theme-d1" style="width:260px"></a></li>-->
    <a href='login.php' target="_top" class="w3-theme-d2" style="margin-left:150px;">Log Out</a>
  </ul>
</div>
</body>
</html>