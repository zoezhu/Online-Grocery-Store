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
<form name="login" action="register_next.php" method="post">
<div class="w3-main w3-padding-12 w3-container">
    <h1 class="w3-text-teal">Online Grocery Delivery - Sign Up</h1>
    <p>Thank you for starting the sign-up process! By signing up, you will be able to shop online for groceries and get them delivered to your door! Begin by filling out the form below to create an account and have access to the service.</p>
<p>
        <table class="w3-table-all" style="width:700px;">


            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">User Type</th>
                <th>
                    <input type="radio" name="user_type" value="home"checked> Home Customer<br>
                    <input type="radio" name="user_type" value="business" > Business Customer<br>
                </th>
                    
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">First Name</th>
                <th><input type="text" name="first_name" required style="width:530px;height:35px;"></th> 
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Last Name</th>
                <th><input type="text" name="last_name" required style="width:530px;height:35px;"></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;" >Username</th>
                <th><input type="text" name="user_name" required style="width:530px;height:35px;"></th>
            </tr>
             <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Password</th>
                <th><input type="password" name="pwd" style="width:530px;height:35px;" required></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Email</th>
                <th><input type="email" name="email" style="width:530px;height:35px;" required></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Telephone</th>
                <th><input type="tel" name="tel" pattern='\d{3}[\-]\d{3}[\-]\d{4}' title='Phone Number (Format: 555-555-5555' style="width:530px;height:35px;" required></th>
            </tr>
           
            
        
        </table></p>
</div>
    
<div class="w3-main w3-container">
        <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:220px;" value="Next Step">
        <a href="<?php if($_SESSION["userType"]==admin) print "admin_table_user.php"; else print "login.php";?>" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:80px;">Cancel</a>
</div>
<p></p>
<p></p>
</form>
    
    
</body>
</html>

