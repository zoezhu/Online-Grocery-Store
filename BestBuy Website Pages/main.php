<!DOCTYPE html>
<?php
session_start();
include_once("cart/config.php");
//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme-black.css">
<link rel="stylesheet" href="css/Roboto.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="cart/style/style.css"/>
<style>
html, body, h1, h2, h3, h4, h5, h6 {
	font-family: "Roboto", sans-serif
}
.w3-sidenav a, .w3-sidenav h4 {
	padding: 12px;
}
.w3-navbar li a {
	padding-top: 12px;
	padding-bottom: 12px;
}
</style>
<body>
<!-- Main content: shift it to the right by 250 pixels when the sidenav is visible -->
<div class="w3-main"> <img src="banner.jpg" style="width: 100%;" />
  <div class="w3-row w3-padding-12">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Welcome! Online Grocery Delivery</h1>
      <p>Welcome to the online grocery delivery service, where you can order groceries online and have them delivered right to your door! Browse the categories to the left and checkout with your items. Be sure to stop by again!</p>
      <p>
      <form name="storeselect" action="storeselect.php" method="post">
        <table class="w3-table-all" style="width:700px;">
          <tr class="w3-table-all tr">
            <th style="width:120px;vertical-align:middle;color:#666666;">Choose Store:</th>
            <th> <?php $result = $mysqli->query("Select storeName as storeName from store");

echo "<select name='storeName'>";
while ($row = mysqli_fetch_array($result)) {
   
	
	echo "<option";
	if($row['storeName']==$_SESSION['sname'])
		echo " selected";
	echo " value='" . $row['storeName'] . "'>" . $row['storeName'] . "</option>";
	
}
echo "</select>";

?>
     
            </th>
            <th> <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:220px;" value="Select">
            </th>
          </tr>
        </table>
      </form>
      </p>
      <h4>Product Sample:</h4>
      <p>
        <!-- Products List Start -->
        <?php

    

    $results = $mysqli->query("SELECT p.productid, p.gwpname, p.cost, p.description, s.amount, c.gwcname AS category, b.gwbname AS brand FROM product P, category C, brand B, storage S where P.categoryID = C.categoryID AND B.brandID = P.brandID and s.productID = p.productid and s.amount > 0 ORDER BY RAND() LIMIT 2"); 

   
if($results){ 
$products_item = '<ul class="products">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<li class="product">
	<form method="post" action="cart/cart_update.php">
	<div class="product-content"><h3>{$obj->gwpname}</h3>
	<div class="product-desc">{$obj->description}</div>
	<hr />
	<div>{$obj->brand}</div>
	<div>{$obj->category}</div>
	<div class="product-info">
	Price {$currency}{$obj->cost} 
	
	<fieldset>
	
	<label>
		<span>Quantity</span>
		<input type="text" size="2" maxlength="2" name="product_qty" value="1" />
	</label>
	
	</fieldset>
	<input type="hidden" name="productid" value="{$obj->productid}" />
	<input type="hidden" name="type" value="add" />
	<input type="hidden" name="return_url" value="{$current_url}" />
	<div align="center"><button type="submit" class="add_to_cart">Add</button></div>
	</div></div>
	</form>
	</li>
EOT;
}
$products_item .= '</ul>';
echo $products_item;
}
?>
        <!-- Products List End -->
      </p>
    </div>
    <div class="w3-third w3-container">
      <h1 class="w3-text-teal">How Does It Work?</h1>
      <ol type="1">
        <li>Browse the website for the product(s) you desire. Either browse by using the navigation organized by category, or do a search for a specific product.</li>
        <li>Use the shopping cart to add and remove items before you check out. You may also edit the quantity of the product.</li>
        <li>When you are ready to purchase your groceries, click on Checkout.</li>
        <li>You will confirm the purchase and then wait for the groceries to be delivered to your door within 48 hours.</li>
        <li>The delivery person will collect payment upon arrival as you receive your groceries.</li>
        <li>Enjoy! Come back again for your grocery needs.</li>
      </ol>
    </div>
  </div>
</div>
<footer id="myFooter">
  <div class="w3-container w3-theme-l2 w3-padding-32">
    <h4></h4>
  </div>
  <div class="w3-container w3-theme-l1">
    <p>Copyright 2016</p>
  </div>
</footer>
<!-- END MAIN -->
</div>
</body>
</html>
