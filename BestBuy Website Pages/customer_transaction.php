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
    <h1 class="w3-text-teal">My Transaction</h1>
        <table class="w3-table-all" style="width:700px;">
            <tr class="w3-table-all tr">
                <th style="width:20px;vertical-align:middle;color:#666666;">#</th>
                <th style="width:150px;vertical-align:middle;color:#666666;">Customer Name</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">Date</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">In Process</th>
                 <th style="width:85px;vertical-align:middle;color:#666666;"></th>
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
    
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
    
    if($userType == "bcustomer" || $userType == "hcustomer")
        $sql = "select * from transaction where customerName='{$username}'";
    else if($userType == 'region_manager')
        $sql = "select * from transaction t,region r,store s where s.storeID=t.storeID and s.regionID = r.regionID and  r.regionManagerName='{$username}'";
    else
        $sql = "select * from transaction t,store s where s.storeID=t.storeID and s.storeManagerName='{$username}'";
            
    $result = $conn->query($sql);
    
    if($result)
    {
        $count = 0;
        while($row = $result->fetch_assoc())
        {
            $count += 1;
            print "<tr class=\"w3-table-all tr w3-hover-green\">
                <th style=\"width:20px;vertical-align:middle;color:#666666;\">$count</th>
                <th style=\"width:150px;vertical-align:middle;color:#666666;\">{$row[customerName]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$row[date]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">";
            
            
            if(!$row[in_process]){
                print "On the way</th>";
                
                if($userType == "bcustomer" || $userType == "hcustomer")
                    print"<th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"><a href=\"process_finish.php?transactionID={$row[transactionID]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:70px;margin-left:0px;\">Finish</a></th></th></tr>";
                else
                    print"<th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"></th></th></tr>";
                
                // transaction_instance
                print"<tr class=\"w3-table-all tr w3-hover-green\"><th style=\"width:500px;vertical-align:middle;color:#666666;\">";
                
                $sql1="select * from transaction_instance t,product p where t.productionID=p.productID and t.transactionID={$row[transactionID]}";
                $result1=$conn->query($sql1);
                
                while($row1 = $result1->fetch_assoc()){
                    print "Product: {$row1[gwpname]}, \${$row1[cost]}, (Qty){$row1[quantity]}<br>";
                }
                
            }
            else{
                print "Finish</th>";
                if($userType == "bcustomer" || $userType == "hcustomer")
                    print "<th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"><a href=\"transaction_rating.php?transactionID={$row[transactionID]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:70px;margin-left:0px;\">Rating</a></th></th></tr>";
                else
                    print"<th style=\"width:80px;vertical-align:middle;text-align:center;color:#666666;\"></th></th></tr>";
                // transaction_instance
                print"<tr class=\"w3-table-all tr w3-hover-green\"><th style=\"width:500px;vertical-align:middle;color:#666666;\">";
                
                $sql1="select * from transaction_instance t,product p where t.productionID=p.productID and t.transactionID={$row[transactionID]}";
                $result1=$conn->query($sql1);
                
                while($row1 = $result1->fetch_assoc()){
                    print "Product: {$row1[gwpname]}, \${$row1[cost]}, (Qty){$row1[quantity]}<br>";
                }
            }
            print "</th></tr>";
        }        
    }
            
    print "</table><p>They are {$count} results returned.";
       
    ?>
    
  
</div>
</body>
</html>

