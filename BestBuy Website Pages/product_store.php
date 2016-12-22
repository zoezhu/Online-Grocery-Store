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
<div class="w3-main w3-padding-64 w3-container">
    <h1 class="w3-text-teal">
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
        
        $storeID = $_GET['storeID'];
        $_SESSION["storeID"] = $storeID;
        $sql="select storeName from store where storeID={$storeID}";
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
        print "{$row["storeName"]}";
        
        ?>
    </h1>
    <a href="product_store_add.php?storeID=<?php print "{$storeID}";?>" class="w3-btn w3-hover-red w3-round-large" style="width:150px;margin-left:0px;">add new product</a><p></p>
        <table class="w3-table-all" style="width:900px;">
            <tr class="w3-table-all tr">
                <th style="width:20px;vertical-align:middle;color:#666666;">#</th>
                <th style="width:80px;vertical-align:middle;color:#666666;">Product ID</th>
                <th style="width:150px;vertical-align:middle;color:#666666;">Product Name</th>
                <th style="width:80px;vertical-align:middle;color:#666666;">Product Price</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">Brand Name</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">Category Name</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">Inventory</th>
                <th style="width:80px;vertical-align:middle;text-align:center;color:#666666;"></th>
                <th style="width:80px;vertical-align:middle;text-align:center;color:#666666;"></th>
            </tr>
        
        
    
    <?php
    
    $sql = "select p.productID,gwpname,cost,gwbname,amount,gwcname from product p,brand d,category c,storage s where p.brandID=d.brandID and p.categoryID=c.categoryID and s.productID=p.productID and s.storeID={$storeID}";   

// print "<script type='text/javascript'>alert('$sql');location='backEndSide.php'; </script>"; 

    $result = $conn->query($sql);
    
    if($result)
    {
        $count = 0;
        while($row = $result->fetch_assoc())
        {
            $count += 1;
            print "<tr class=\"w3-table-all tr w3-hover-green\">
                <th style=\"width:20px;vertical-align:middle;color:#666666;\">$count</th>
                <th style=\"width:80px;vertical-align:middle;color:#666666;\">{$row[productID]}</th>
                <th style=\"width:150px;vertical-align:middle;color:#666666;\">{$row[gwpname]}</th>
                <th style=\"width:80px;vertical-align:middle;color:#666666;\">\$ {$row[cost]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$row[gwbname]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$row[gwcname]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$row[amount]}</th>
                <th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"><a href=\"product_store_update.php?productID={$row[productID]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:80px;margin-left:0px;\">update</a></th>
                <th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"><a href=\"product_store_delete.php?productID={$row[productID]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:80px;margin-left:0px;\">delete</a></th>
            </tr>";
        }
        
    }
            
    print "</table><p>They are {$count} results returned.";
       
    ?>
    
  
</div>
</body>
</html>

