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

<form name="login" action="search_result_old.php" method="post">
<div class="w3-main w3-padding-64 w3-container">
    <h1 class="w3-text-teal">Search by</h1>
    
        <table class="w3-table-all" style="width:700px;">


            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Product name</th>
                <th><input type="text" name="p_name" style="width:530px;height:35px;"></th>
                    
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Price</th>
                <th><input type="text" pattern="\d{2}\.\d{2}" name="price" style="width:530px;height:35px;" title='Price (Format: 99.99)'></th> 
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Category</th>
                <th><input type="text" name="p_category"  style="width:530px;height:35px;"></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;" >Brand</th>
                <th><input type="text" name="p_brand"  style="width:530px;height:35px;"></th>
            </tr>
            <tr class="w3-table-all tr">
                <th style="width:120px;vertical-align:middle;color:#666666;">Description</th>
                <th><input type="text" name="p_description" style="width:530px;height:35px;" ></th>
            </tr>
            
        
        </table>
</div>
    
<div class="w3-main w3-container">
        <input type="submit" class="w3-btn w3-hover-red w3-round-large" style="width:100px;margin-left:280px;" value="GO!">
</div>
</form>
    
    
</body>
</html>

