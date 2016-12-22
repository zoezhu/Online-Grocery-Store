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
    <h1 class="w3-text-teal">Store Management</h1>
    <a href="store_add.php" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:0px;">add store</a><p></p>
        <table class="w3-table-all" style="width:1000px;">
            <tr class="w3-table-all tr">
                <th style="width:20px;vertical-align:middle;text-align:center;color:#666666;">#</th>
                <th style="width:80px;vertical-align:middle;text-align:center;color:#666666;">Store ID</th>
                <th style="width:150px;vertical-align:middle;text-align:center;color:#666666;">Store Name</th>
                <th style="width:90px;vertical-align:middle;color:#666666;">Region</th>
                <th style="width:90px;vertical-align:middle;text-align:center;color:#666666;">State</th>
                <th style="width:90px;vertical-align:middle;text-align:center;color:#666666;">City</th>
                <th style="width:90px;vertical-align:middle;text-align:center;color:#666666;">Zip Code</th>
                <th style="width:90px;vertical-align:middle;text-align:center;color:#666666;">Store Manager</th>
                <th style="width:80px;vertical-align:middle;text-align:center;color:#666666;"></th>
                <th style="width:80px;vertical-align:middle;text-align:center;color:#666666;"></th>
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
    
    
    $sql = "select * from store s,region r,address a,city c where s.addressID=a.addressID and s.regionID=r.regionID and a.cityName=c.cityName";    
    $result = $conn->query($sql);
            
    
    if($result)
    {
        $count = 0;
        while($row = $result->fetch_assoc())
        {
            $count += 1;
            print "<tr class=\"w3-table-all tr w3-hover-green\">
                <th style=\"width:20px;vertical-align:middle;color:#666666;\">$count</th>
                <th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\">{$row[storeID]}</th>
                <th style=\"width:150px;vertical-align:middle;text-align:center;color:#666666;\">{$row[storeName]}</th>
                <th style=\"width:90px;vertical-align:middle;text-align:center;color:#666666;\">{$row[regionName]}</th>
                <th style=\"width:90px;vertical-align:middle;text-align:center;color:#666666;\">{$row[state]}</th>
                <th style=\"width:90px;vertical-align:middle;text-align:center;color:#666666;\">{$row[cityName]}</th>
                <th style=\"width:90px;vertical-align:middle;text-align:center;color:#666666;\">{$row[zip_code]}</th>
                <th style=\"width:90px;vertical-align:middle;text-align:center;color:#666666;\">{$row[storeManagerName]}</th>
                <th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"><a href=\"store_update.php?storeID={$row[storeID]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:80px;margin-left:0px;\">update</a></th>
                <th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"><a href=\"store_delete.php?storeID={$row[storeID]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:80px;margin-left:0px;\">delete</a></th>
            </tr>";
        }
        
    }
            
    print "</table><p>They are {$count} results returned.";
    ?>
    
  
</div>
</body>
</html>

