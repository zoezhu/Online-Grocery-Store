<!DOCTYPE html>
<?php
session_start();
?>
<html>
<title>Online Grocery Delivery</title>
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
<img src="banner.jpg" style="width: 100%;" />
<form name="login" action="register_h.php" method="post">
<div class="w3-main w3-padding-12 w3-container">
    <h1 class="w3-text-teal">Online Grocery Delivery - Sign Up</h1>
    <h3 class="w3-text-teal">Home Customer</h3>
    <p>Please continue the sign-up process by completing the next part of the form below.</p>
        <table class="w3-table-all" style="width:700px;">

            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Gender</th>
                <th>
                    <input type="radio" name="gender" value="male" checked> Male<br>
                    <input type="radio" name="gender" value="female" > Female<br>
                </th>
                    
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Birth Date</th>
                <th><input type="date" name="birth_date" required style="width:530px;height:35px;"></th> 
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Income</th>
                <th><input type="number" name="income" min=0 required style="width:530px;height:35px;"></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;" >Marrige Status</th>
                <th>
                    <input type="radio" name="marrige_status" value="single" checked> Single<br>
                    <input type="radio" name="marrige_status" value="married" > Married<br>
                    <input type="radio" name="marrige_status" value="divorced"> Divorced<br>
                    <input type="radio" name="marrige_status" value="widowed"> Widowed<br>
                </th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">City</th>
                <th>
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
                ?>
                </th>
                
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Apartment</th>
                <th><input type="text" name="apartment" required style="width:530px;height:35px;"></th>
            </tr>
<!--
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Zip Code</th>
                <th><input type="text" name="zip" required style="width:530px;height:35px;"></th>
            </tr>
-->
        
        </table>
</div>
    
<div class="w3-main w3-container">
        <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:230px;" value="Register">
        <a href="<?php if($_SESSION["userType"]==admin) print "admin_table_user.php"; else print "login.php";?>" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:80px;">Cancel</a>
</div>
</form>
<br><br><br>    
    
</body>
</html>

