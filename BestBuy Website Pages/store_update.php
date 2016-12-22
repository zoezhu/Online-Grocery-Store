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

<form name="login" action="store_update_process.php" method="post">
<div class="w3-main w3-padding-64 w3-container">
    <h1 class="w3-text-teal">Fill in store information</h1>
        <table class="w3-table-all" style="width:700px;">
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Store ID</th>
                <th><?php print "{$_GET["storeID"]}"; $_SESSION["storeID"]=$_GET["storeID"]?></th>    
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
            
            $storeID=$_GET['storeID'];
            $sql="select * from store where storeID={$storeID}";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            
      
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Store Name</th>
                <th><input type=text style=\"width:530px;vertical-align:middle;color:#666666;\" name=\"storename\" value=\"{$row[storeName]}\"\"></th></tr>";
    
                
                // region
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Region</th><th>";

               $sql = "select * from region";
                $result = $conn->query($sql);
                if($result)
                {
                    while($row = $result->fetch_assoc())
                    {
                        print "<input type=\"radio\" name=\"region\" value=\"{$row[regionID]}\" checked>  {$row[regionName]}<br>";
                    }
                } 
      
            
            //storeManager
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Region Manager</th><th>";

               $sql = "select * from salesperson where job_title='store_manager'";
                $result = $conn->query($sql);
                if($result)
                {
                    while($row = $result->fetch_assoc())
                    {
                        print "<input type=\"radio\" name=\"storeManager\" value=\"{$row[salespersonName]}\" checked>  {$row[first_name]}, {$row[last_name]}<br>";
                    }
                } 
            
            // city
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">City</th><th>";
                
                
               $sql = "select * from city";
                $result = $conn->query($sql);
                if($result)
                {
                    while($row = $result->fetch_assoc())
                    {
                        print "<input type=\"radio\" name=\"city\" value=\"{$row[cityName]}\">  {$row[cityName]}, {$row[state]}<br>";
                    }

                }  
            //street
                print "
                <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Street</th><th>";
                    
                $sql = "select * from street";    
                $result = $conn->query($sql);
                if($result)
                {
                    while($row = $result->fetch_assoc())
                    {
                        print "<input type=\"radio\" name=\"street\" value=\"{$row[zip_code]}\">  {$row[streetName]}, {$row[zip_code]}<br>";
                    }
                }  
                ?>
                </th>
                
            </tr>
        
        </table>
</div>
    
<div class="w3-main w3-container">
        <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:300px;" value="Update">
</div>
</form>
<br><br><br>    
    
</body>
</html>

