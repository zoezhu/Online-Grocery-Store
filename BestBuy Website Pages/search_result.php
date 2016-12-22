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
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
.w3-sidenav a,.w3-sidenav h4 {padding: 12px;}
.w3-navbar li a {
    padding-top: 12px;
    padding-bottom: 12px;
}
</style>
    
<body>
<!-- View Cart Box Start -->
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
	echo '<div class="cart-view-table-front" id="view-cart">';
	echo '<h3>Shopping Cart</h3>';
	echo '<form method="post" action="cart/cart_update.php">';
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
		echo '<td>Qty <input type="number" size="2" maxlength="2" min=1 step=1 max="$product_qty" name="product_qty['.$productid.']" value="'.$product_qty.'" style="width:40px;"/></td>';
		echo '<td>'.$gwpname.'</td>';
		echo '<td><input type="checkbox" name="remove_code[]" value="'.$productid.'" /> Remove</td>';
		echo '</tr>';
		$subtotal = ($cost * $product_qty);
		$total = ($total + $subtotal);
	}
	echo '<td colspan="4">';
	echo '<button type="submit">Update</button><a href="cart/view_cart.php" class="button">Checkout</a>';
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
 
<h1 class="w3-text-teal" align="left" style="margin:2px"><?php echo $_GET['ctg']." - ".$_SESSION['sname'] ?></h1>
</div>
  
      

  <!-- Products List Start -->
<?php
$ctg = $_GET['ctg'];
$_SESSION['ctg']=$ctg;

$sname = $_SESSION['sname'];
    
    
$results = $mysqli->query("SELECT count(*) as c FROM product P, category C, brand B, storage S, store T where S.storeID = T.storeID and T.storeName = '{$sname}' and P.categoryID = C.categoryID AND B.brandID = P.brandID and s.productID = p.productid and c.gwcname='{$ctg}' and s.amount > 0 ");    
$obj = $results->fetch_object();   
if($obj->c==0){
	echo <<< EOT
<div style="padding:10px;">There are no products in stock under this category right now. Please check back again soon.</div>
EOT;

}
else{  
print "<a href=\"search_result_order.php?ord=1\" target=\"main\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:200px;margin-left:50px;\">Order by Price DESC</a>";
print "<a href=\"search_result_order.php?ord=2\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:200px;margin-left:50px;\">Order by Price ASC</a>";

    
//    print "<script type='text/javascript'>alert('{$_GET['order']}');location='search_result.php';";
    
    
// whether ordered by price
if($_GET['ord']==1)
    $results = $mysqli->query("SELECT p.productid, p.gwpname, p.cost, p.description, s.amount,  t.storeName, c.gwcname AS category, b.gwbname AS brand FROM product P, category C, brand B, storage S, store T where S.storeID = T.storeID and T.storeName = '{$sname}' and P.categoryID = C.categoryID AND B.brandID = P.brandID and s.productID = p.productid and c.gwcname='{$ctg}' and s.amount > 0  ORDER BY cost DESC"); 
else
    $results = $mysqli->query("SELECT p.productid, p.gwpname, p.cost, p.description, s.amount, t.storeName, c.gwcname AS category, b.gwbname AS brand FROM product P, category C, brand B, storage S, store T where S.storeID = T.storeID  and T.storeName = '{$sname}' and P.categoryID = C.categoryID AND B.brandID = P.brandID and s.productID = p.productid and c.gwcname='{$ctg}' and s.amount > 0  ORDER BY cost ASC"); 

   
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
	<div>In Stock: {$obj->amount}</div>
	<fieldset>
	
	<label>
		<span>Quantity</span>
		<input type="number" size="2" maxlength="2" name="product_qty" value="1" min=1 step=1 max="{$obj->amount}" style="width:40px;"/>
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
}}
    
    

?>    
<!-- Products List End -->
</body>
</html>

