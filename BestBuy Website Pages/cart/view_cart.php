<?php
session_start();
include_once("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View shopping cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/w3-theme-black.css">
<link rel="stylesheet" href="../css/Roboto.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
</head>
<body>
<div class="w3-main w3-padding-64 w3-container">
  <h1 class="w3-text-teal" align="left" style="margin:2px">View Cart</h1>
</div>
<br/>
<div align="center">
 
    <form action="dbupdate.php" method="get">
  <input type="submit" class="button" value="Submit Order">
</form>
    </a>
  </form>
 
</div>
<br/>
<div class="cart-view-table-back">
  <form method="post" action="cart_update.php">
    <table width="100%"  cellpadding="6" cellspacing="0">
      <thead>
        <tr>
          <th>Quantity</th>
          <th>Name</th>
          <th>Price</th>
          <th>Total</th>
          <th>Remove</th>
        </tr>
      </thead>
      <tbody>
        <?php
	if(isset($_SESSION["cart_products"])) //check session var
    {
		$total = 0; //set initial total value
		$b = 0; //var for zebra stripe table 
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			//set variables to use in content below
			$gwpname = $cart_itm["gwpname"];
			$product_qty = $cart_itm["product_qty"];
			$cost = $cart_itm["cost"];
			$productid = $cart_itm["productid"];
			$subtotal = ($cost * $product_qty); //calculate Price x Qty
			
		   	$bg_color = ($b++%2==1) ? 'odd' : 'even'; //class for zebra stripe 
		    echo '<tr class="'.$bg_color.'">';
			echo '<td><input type="number" size="2" maxlength="2" min=1 step=1 max="$product_qty" name="product_qty['.$productid.']" value="'.$product_qty.'" style="width:40px;"/></td>';
			echo '<td>'.$gwpname.'</td>';
			echo '<td>'.$currency.$cost.'</td>';
			echo '<td>'.$currency.$subtotal.'</td>';
			echo '<td><input type="checkbox" name="remove_code[]" value="'.$productid.'" /></td>';
            echo '</tr>';
			$total = ($total + $subtotal); //add subtotal to total var
        }
		
		$grand_total = $total + $shipping_cost; //grand total including shipping cost
		foreach($taxes as $key => $value){ //list and calculate all taxes in array
				$tax_amount     = round($total * ($value / 100));
				$tax_item[$key] = $tax_amount;
				$grand_total    = $grand_total + $tax_amount;  //add tax val to grand total
		}
		
		$list_tax       = '';
		foreach($tax_item as $key => $value){ //List all taxes
			$list_tax .= $key. ' : '. $currency. sprintf("%01.2f", $value).'<br />';
		}
		$shipping_cost = ($shipping_cost)?'Delivery Cost : '.$currency. sprintf("%01.2f", $shipping_cost).'<br />':'';
	}
    ?>
        <tr>
          <td colspan="5"><span style="float:right;text-align: right;"><?php echo $shipping_cost. $list_tax; ?>Amount Payable : <?php echo sprintf("%01.2f", $grand_total);?></span></td>
        </tr>
        <tr>
          <td colspan="5"><a href="index.php" class="button">Add More Items</a>
            <button type="submit" class="button">Update</button></td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" name="return_url" value="<?php 
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
echo $current_url; ?>" />
  </form>
</div>
</body>
</html>
