<!DOCTYPE html>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme-black.css">
<link rel="stylesheet" href="css/Roboto.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {padding: 12px;}
</style>
<body>

<!--Search box-->
<div class="w3-theme-l5 w3-container" style="z-index:3;">
<p></p>
<!--
<form name="searchBox" action="" method="POST">
    <input type="text" name="serchInput" style="width:135px;height:35px;">
    <input class="w3-btn w3-hover-red w3-round-large" type="submit" value="GO !">
</form>  
-->
<!--
<a href="adSearch.php" class="w3-small" target="main">Advanced Search</a>
<p></p>
-->
</div>

<!-- Sidenav -->
<nav class="w3-sidenav w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;" id="side">
    <h4><b>Management</b></h4>
  <a href="admin_table_store.php" target="main" class="w3-hover-black">Store</a>
  <a href="admin_table_mng.php?mng=product" target="main" class="w3-hover-black">Product</a>
  <a href="admin_table_mng.php?mng=promotion" target="main" class="w3-hover-black">Promotion</a>
  <a href="admin_table_mng.php?mng=category" target="main" class="w3-hover-black">Category</a> 
  <a href="admin_table_mng.php?mng=brand" target="main" class="w3-hover-black">Brand</a>
  <a href="admin_table_mng.php?mng=transaction" target="main" class="w3-hover-black">Transaction</a>
  <a href="admin_table_mng.php?mng=address" target="main" class="w3-hover-black">Address</a>
  <a href="admin_table_user.php" target="main" class="w3-hover-black">User</a>
</nav>

    
</body>
</html>

