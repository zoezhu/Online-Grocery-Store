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
    <h1 class="w3-text-teal">Table Management</h1>
    
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
    
    $mng = $_GET['mng'];
    switch($mng){
        case "store":
            $sql = "select s.storeID,s.salespersonName,r.name,r.salespersonName,c.cityName,c.state,st.zip_code,st.streetName,a.apartment from store s,region r,address a,city c,street st where s.addressID=a.addressID and a.cityName=c.cityName and a.zip_code=st.zip_code and s.regionID=r.regionID";
            $colnum = 9;
            break;
        case "product":
            $sql = "select p.productID,p.gwpname as 'product name',p.cost,c.gwcname as 'category',b.gwbname as band from product p,category c,brand b where p.categoryID=c.categoryID and b.brandID=b.brandID";
            $colnum = 5;
            break;
        case "promotion":
            $sql = "SELECT p.promotionID as 'promotion ID', pr.gwpname as 'product name', p.start_date as 'start date', p.end_date as 'end date', p.discount as 'discount' FROM promotion p, product pr WHERE p.productID=pr.productID";
            $colnum = 5;
            break;
        case "category":
            $sql = "SELECT c.categoryID as 'category ID', c.gwcname as 'category name',p.gwpname as 'product name', p.cost as 'product price', b.gwbname as 'product brand',p.description as description from category c, product p, brand b WHERE c.categoryID=p.categoryID and p.brandID=b.brandID";
            $colnum = 6;
            break;
        case "brand":
            $sql = "SELECT b.brandID as 'brand ID', b.gwbname as 'brand name' from brand b";
            $colnum = 6;
            break;
        case "transaction":
            $sql = "SELECT t.transactionID as 'transaction ID', t.date as 'date', t.customerName as 'customer', t.in_process as 'whether finish' FROM transaction t";
            $colnum = 4;
            break;
        case "address":
            $sql = "SELECT a.addressID as 'address ID', a.cityName as 'city', c.state as 'state', a.zip_code as 'zip code', s.streetName as 'street', a.apartment as 'apartment' FROM address a, city c, street s WHERE a.cityName=c.cityName and a.zip_code = s.zip_code";
            $colnum = 6;
            break;
        case "user":
            $sql = "";
            break;
    }
      
    $result = $conn->query($sql);
            
            
    if($result)
    {
        // print table head
        //!!! work!!!
        $values = $result->fetch_all(MYSQLI_ASSOC);
        $columns = array();
        print "<table class=\"w3-table-all\" style=\"width:900px;\">
            <tr class=\"w3-table-all tr\">";
        if(!empty($values)){
            $columns = array_keys($values[0]);
            $i = 0;
            while($i < $colnum){
                print "<th style=\"width:100px;vertical-align:middle;text-align:center;color:#666666;\">$columns[$i]</th>";
                $i += 1;
            }
        }
        print "</tr> ";
        
        // print results
        $result = $conn->query($sql);
        $count = 0;
        while($row = $result->fetch_assoc())
        {
            $count += 1;
            
            $i = 0;
            print "<tr class=\"w3-table-all tr w3-hover-green\">";
            while($i < $colnum){
                print "<th style=\"width:100px;vertical-align:middle;text-align:center;color:#666666;\">{$row[$columns[$i]]}</th>";
                $i += 1;
            }  
    
            print "</tr>";
            
        }
        
    }
            
    print "</table><p>They are {$count} results returned.";
       
    ?>
    
  
</div>
</body>
</html>

