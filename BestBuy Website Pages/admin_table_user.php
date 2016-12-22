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
    <h1 class="w3-text-teal">User Management</h1>
    <a href="create_account.php" class="w3-btn w3-hover-red w3-round-large" style="width:150px;margin-left:0px;">add customer</a><p></p>
        <table class="w3-table-all" style="width:900px;">
            <tr class="w3-table-all tr">
                <th style="width:20px;vertical-align:middle;color:#666666;">#</th>
                <th style="width:150px;vertical-align:middle;color:#666666;">User Name</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">User Type</th>
                <th style="width:120px;vertical-align:middle;color:#666666;">Password</th>
                <th style="width:80px;vertical-align:middle;color:#666666;">Update</th>
                <th style="width:80px;vertical-align:middle;color:#666666;">Delete</th>
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
    
    
    $sql = "select * from users";    
    $result = $conn->query($sql);
    
    if($result)
    {
        $count = 0;
        while($row = $result->fetch_assoc())
        {
            $count += 1;
            print "<tr class=\"w3-table-all tr w3-hover-green\">
                <th style=\"width:20px;vertical-align:middle;color:#666666;\">$count</th>
                <th style=\"width:150px;vertical-align:middle;color:#666666;\">{$row[userName]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$row[userType]}</th>
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$row[pass]}</th>
                <th style=\"width:80px;vertical-align:middle;color:#666666;\"><a href=\"account.php?username={$row[userName]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:70px;margin-left:0px;\">update</a></th>";
            
            //can't delete admin
             if($row[userName]!="admin"){
                 print "<th style=\"width:80px;vertical-align:middle;color:#666666;\"><a href=\"account_delete.php?usrname={$row[userName]}\" class=\"w3-btn w3-hover-red w3-round-large\" style=\"width:70px;margin-left:0px;\">delete</a></th>";
             }
            else{
                print "<th style=\"width:87px;vertical-align:middle;color:#666666;\"></th>";
            }
                
        }
        
    }
            
    print "</tr></table><p>They are {$count} results returned.";
       
    ?>
    
  
</div>
</body>
</html>

