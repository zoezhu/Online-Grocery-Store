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
    <h1 class="w3-text-teal">Account information</h1>
    
        <table class="w3-table-all" style="width:700px;">

            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">User Name</th>
                <th style="width:530px;height:35px;"><?php $username=$_SESSION['username'];print "{$username}";?></th>
                    
            </tr>
            
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">User Type</th>
                <th style="width:530px;height:35px;"><?php print "{$_SESSION['userType']}";?></th>        
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
            
            // show fileds for bcustomer
            if($_SESSION['userType']=="bcustomer"){
                $sql="select * from bcustomer b,address a where b.addressID=a.addressID and b_customerUsername='{$username}'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
//             print "<script type='text/javascript'>alert('here!');location='account_h.php'; </script>";
     
              if($row){
                  print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">First Name</th>
                <th style=\"width:530px;height:35px;\"> {$row[first_name]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Business Category</th>
                <th style=\"width:530px;height:35px;\"> {$row[business_category]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Company GAI </th>
                <th style=\"width:530px;height:35px;\"> {$row[company_GAI]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">City</th>
                <th style=\"width:530px;height:35px;\">{$row[cityName]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Zip Code</th>
                <th style=\"width:530px;height:35px;\">{$row[zip_code]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Email</th>
                <th style=\"width:530px;height:35px;\">{$row[email]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Tel</th>
                <th style=\"width:530px;height:35px;\">{$row[tel]}</th> 
            </tr>";
              } 
            }
            
            // show fileds for hcustomer
            else{
                $sql="select * from hcustomer h,address a where h.addressID=a.addressID and h_customerUsername='{$username}'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                if($row){
                  print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">First Name</th>
                <th style=\"width:530px;height:35px;\"> {$row[first_name]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Last Name</th>
                <th style=\"width:530px;height:35px;\"> {$row[last_name]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Gender </th>
                <th style=\"width:530px;height:35px;\"> {$row[gender]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Birth Date</th>
                <th style=\"width:530px;height:35px;\"> {$row[birth_date]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Income</th>
                <th style=\"width:530px;height:35px;\"> {$row[income]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Marriage Status</th>
                <th style=\"width:530px;height:35px;\"> {$row[marriage_status]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">City</th>
                <th style=\"width:530px;height:35px;\">{$row[cityName]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Zip Code</th>
                <th style=\"width:530px;height:35px;\">{$row[zip_code]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Email</th>
                <th style=\"width:530px;height:35px;\">{$row[email]}</th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Tel</th>
                <th style=\"width:530px;height:35px;\">{$row[tel]}</th> 
            </tr>";
                    
              }
            }
 
        ?>
            
        </table>
</div>
    
<div class="w3-main w3-container">
    <a href="account.php?username=<?php print "{$_SESSION["username"]}";?>" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:300px;">Update</a>
</div>
<br><br>    
    
</body>
</html>

