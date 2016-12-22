<?php
session_start();
include_once("config.php");

//			$username = ($_SESSION["username"]);
//            $storeID = $_SESSION["sname"];

            $sname = ($_SESSION['sname']);
			$storeID = $mysqli->query("SELECT storeID as storeID FROM store WHERE storeName = '{$sname}'");
			$row=$storeID->fetch_assoc();
			$sID = $row[storeID];
			
			$username = ($_SESSION["username"]);
			$mysqli->query("INSERT INTO transaction (date, customerName, in_process, storeID) VALUES (CURDATE(), '{$username}', 0, {$sID})");





//			$mysqli->query("INSERT INTO transaction (date, customerName, in_process, storeID) VALUES (CURDATE(), '{$username}', 0,{$_SEESION['storeID']})");
			$max = $mysqli->query("SELECT MAX(transactionID) as tid FROM transaction");
			$row=$max->fetch_assoc();
			$tid = $row[tid];
			$_SESSION["transactionID"]=$tid;
			
		foreach ($_SESSION["cart_products"] as $cart_itm)
        {
			$productid = $cart_itm["productid"];
		    $qty = $cart_itm["product_qty"];
			$mysqli->query("UPDATE storage SET amount = amount - {$qty} WHERE productID = {$productid}");
			$mysqli->query("INSERT INTO transaction_instance (transactionID, productionID, quantity) VALUES ({$tid}, {$productid}, {$qty})");
            
            print "";
		}
		
		
		
//clear cart
unset($_SESSION['cart_products']);

		header('Location: finish.php');
    exit;
   
 ?>