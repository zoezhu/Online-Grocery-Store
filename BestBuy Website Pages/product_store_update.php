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

<form name="login" action="product_store_update_process.php" method="post">
<div class="w3-main w3-padding-64 w3-container">
    <h1 class="w3-text-teal">Fill in product information</h1>
        <table class="w3-table-all" style="width:700px;">
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Product ID</th>
                <th><?php $productID=$_GET["productID"];print "{$productID}"; $_SESSION["productID"]=$productID;?></th>
            </tr>
            
            <?php
            // connect database
                $servername = $_SESSION["servername"];
                $dbusername = $_SESSION["dbusername"];
                $dbpassword = $_SESSION["dbpassword"];
                $database = $_SESSION["database"];
                $conn = new mysqli($servername, $dbusername, $dbpassword, $database);

            // check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                } 
            
            $storeID=$_SESSION["storeID"];
            $sql="select * from product p,storage s where s.productID={$productID} and s.storeID={$storeID} and s.productID=p.productID";
            
//             print "<script type='text/javascript'>alert('$sql');location='product_store.php'; </script>";
            
            
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
   
      
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Product Name</th>
                <th><input type=text style=\"width:530px;vertical-align:middle;color:#666666;\" name=\"productname\" value=\"{$row[gwpname]}\"\"></th></tr>
                <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Price</th>
                <th><input type=text pattern=\"\d{2}\.\d{2}\" style=\"width:530px;vertical-align:middle;color:#666666;\" name=\"price\" value=\"{$row[cost]}\"\"></th></tr>
                <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Description</th>
                <th><input type=text style=\"width:530px;vertical-align:middle;color:#666666;\" name=\"description\" value=\"{$row[description]}\"\"></th></tr>";
                //category
                print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Category</th><th>";              
                $amount = $row[amount];    
            
                $sql = "select * from category";
                $result = $conn->query($sql);
            
                if($result)
                {
                    while($row = $result->fetch_assoc())
                    {
                        print "<input type=\"radio\" name=\"category\" value=\"{$row[categoryID]}\"> {$row[gwcname]}<br>";
                    }
                }
            
            // brand
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Brand</th><th>";
                
                
               $sql = "select * from brand";
                $result = $conn->query($sql);
                if($result)
                {
                    while($row = $result->fetch_assoc())
                    {
                        print "<input type=\"radio\" name=\"brand\" value=\"{$row[brandID]}\"> {$row[gwbname]}<br>";
                    }
                }
            
            
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Inventory</th>
                <th><input type=number style=\"width:530px;vertical-align:middle;color:#666666;\" name=\"inventory\" value=\"{$amount}\"\"></th></tr></th></tr>";       
                ?>
            
        </table>
</div>
    
<div class="w3-main w3-container">
        <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:300px;" value="Update">
</div>
</form>
<br><br><br>    
    
</body>
</html>

