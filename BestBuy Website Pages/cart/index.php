<?php
session_start();
include_once("config.php");


//current URL of the Page. cart_update.php redirects back to this URL
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/w3-theme-black.css">
<link rel="stylesheet" href="../css/Roboto.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
</head>
<body>

<!-- View Cart Box Start -->
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
	echo '<div class="cart-view-table-front" id="view-cart">';
	echo '<h3>Shopping Cart</h3>';
	echo '<form method="post" action="cart_update.php">';
	echo '<table width="100%"  cellpadding="6" cellspacing="0">';
	echo '<tbody>';

	$total =0;
	$b = 0;
	foreach ($_SESSION["cart_products"] as $cart_itm)
	{
		$gwpname = $cart_itm["gwpname"];
		$product_qty = $cart_itm["product_qty"];
		$cost = $cart_itm["cost"];
		$productid = $cart_itm["productid"];
		$bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
		echo '<tr class="'.$bg_color.'">';
		echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$productid.']" value="'.$product_qty.'" /></td>';
		echo '<td>'.$gwpname.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$productid.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($cost * $product_qty);
		$total = ($total + $subtotal);
	}
	echo '<td colspan="4">';
	echo '<button type="submit">Update</button><a href="view_cart.php" class="button">Checkout</a>';
	echo '</td>';
	echo '</tbody>';
	echo '</table>';
	
	$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
	echo '</form>';
	echo '</div>';

}
?>
<!-- View Cart Box End -->

<div class="w3-main w3-padding-64 w3-container">
 
<h1 class="w3-text-teal" align="left" style="margin:2px">All Products</h1>
</div>
<!-- Products List Start -->
<?php
$results = $mysqli->query("SELECT p.productid, p.gwpname, p.cost, p.description AS description, c.gwcname AS category, b.gwbname AS brand
FROM product P, category C, brand B
where (P.categoryID = C.categoryID AND B.brandID = P.brandID) ORDER BY p.gwpname ASC"); 
if($results){ 
$products_item = '<ul class="products">';
//fetch results set as object and output HTML
while($obj = $results->fetch_object())
{
$products_item .= <<<EOT
	<li class="product">
	<form method="post" action="cart_update.php">
	<div class="product-content"><h3>{$obj->gwpname}</h3>
	<div class="description">{$obj->description}</div>
	<div class="brand">{$obj->brand}</div>
	<div class="category">{$obj->category}</div>
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
</body>
</html>
