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

<form name="login" action="update_account.php" method="post">
<div class="w3-main w3-padding-64 w3-container">
    <h1 class="w3-text-teal">Update Account</h1>
    
        <table class="w3-table-all" style="width:700px;">

            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">User Name</th>
                <th style="width:530px;height:35px;"><?php $username=$_GET['username'];print "{$username}";?></th>
                    
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
            
                $sql = "select * from users where username='{$username}'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
                $userType = $row[userType];
            ?>
            
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">User Type</th>
                <th style="width:530px;height:35px;"><?php print "{$userType}";?></th>        
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
            
            // specific fileds for bcustomer
            if($userType=="bcustomer"){
                $sql="select * from bcustomer b,address a where b.addressID=a.addressID and b_customerUsername='$username'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
//             print "<script type='text/javascript'>alert('here!');location='account_h.php'; </script>";
     
              if($row){
                  print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">First Name</th>
                <th><input type=\"text\" name=\"first_name\" required style=\"width:530px;height:35px;\" value='{$row[first_name]}'></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Last Name</th>
                <th><input type=\"text\" name=\"last_name\" required style=\"width:530px;height:35px;\" value='{$row[last_name]}'></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Business Category</th>
                <th><input type=\"text\" name=\"business_category\" required style=\"width:530px;height:35px;\" value='{$row[business_category]}'></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Company GAI</th>
                <th><input type=\"text\" name=\"company_gai\" required style=\"width:530px;height:35px;\" value='{$row[company_GAI]}'></th> 
            </tr>";
              } 
              $apartment_field = "Building";
            }
            // specific fileds for hcustomer
            else{
                $sql="select * from hcustomer h,address a where h.addressID=a.addressID and h.h_customerUsername='$username'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();
//             print "<script type='text/javascript'>alert('here!');location='account_h.php'; </script>";
     
              if($row){
                  print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">First Name</th>
                <th><input type=\"text\" name=\"first_name\" required style=\"width:530px;height:35px;\" value='{$row[first_name]}'></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Last Name</th>
                <th><input type=\"text\" name=\"last_name\" required style=\"width:530px;height:35px;\" value='{$row[last_name]}'></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Gender</th>
                <th>
                    <input type=\"radio\" name=\"gender\" value=\"male\"> Male<br>
                    <input type=\"radio\" name=\"gender\" value=\"female\" > Female<br>
                </th>
                    
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Birth Date</th>
                <th><input type=\"date\" name=\"birth_date\" required style=\"width:530px;height:35px;\" value={$row[birth_date]}></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Income</th>
                <th><input type=\"number\" name=\"income\" required style=\"width:530px;height:35px;\" value={$row[income]}></th>
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\" >Marrige Status</th>
                <th>
                    <input type=\"radio\" name=\"marrige_status\" value=\"single\" checked> Single<br>
                    <input type=\"radio\" name=\"marrige_status\" value=\"married\" > Married<br>
                    <input type=\"radio\" name=\"marrige_status\" value=\"divorced\"> Divorced<br>
                    <input type=\"radio\" name=\"marrige_status\" value=\"widowed\"> Widowed<br>
                </th>
            </tr>";
              }
                $apartment_field = "Apartment";
            }
            $apartment = $row[apartment];
            $email = $row[email];
            $tel = $row[tel];
            $pass = $row[pass];
              
            // fileds for address
            print "</th></tr>
                <tr class=\"w3-table-all tr\">
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
                print "</th></tr>
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
     
            // print apartment
            print "<tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">{$apartment_field}</th>
                <th><input type=\"text\" name=\"apartment\" required style=\"width:530px;height:35px;\" value=\"{$apartment}\"></th> 
            </tr>
            <tr class=\"w3-table-all tr\">
                <th style=\"width:120px;vertical-align:middle;color:#666666;\">Password</th>
                <th><input type=\"password\" name=\"pwd\" required style=\"width:530px;height:35px;\" value=\"{$pass}\"></th> 
            </tr>";
            ?>
<!--
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Password</th>
                <th><input type="password" name="pwd" required style="width:530px;height:35px;"></th>
            </tr>
-->
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Email</th>
                <th><input type="email" name="email" style="width:530px;height:35px;" required value="<?php print "{$email}"?>"></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Tel</th>
                <th><input type="tel" name="tel" pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number (Format: 555-555-5555' style="width:530px;height:35px;" required value="<?php print "{$tel}"?>"></th>
            </tr>
        </table>
</div>
    
<div class="w3-main w3-container">
    <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:300px;" value="Submit">
</div>
</form>
<br><br>    
    
</body>
</html>

