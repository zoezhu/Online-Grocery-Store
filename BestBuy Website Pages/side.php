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
</style>
<body>

<!--Search box-->
<div class="w3-theme-l5 w3-container" style="z-index:3;">
<p></p>
<form name="searchBox" action="side_search.php" target="main" method="POST">
    <input type="text" name="serchInput" style="width:135px;height:35px;">
    <input class="w3-btn w3-hover-red w3-round-large" type="submit" value="GO !">
</form>  
<a href="adSearch.php" class="w3-small" target="main">Advanced Search</a>
<p></p>
</div>

<!-- Sidenav -->
<nav class="w3-sidenav w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;" id="side">
    <h4><b>Category</b></h4>
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
    
       // run a sql
        $result = $conn->query("select gwcname from category");

        if($result)
        {

            while($row = $result->fetch_assoc())
            {
                print "<a href=\"search_result.php?ctg={$row[gwcname]}\" class=\"w3-hover-black\" target=\"main\">{$row[gwcname]}</a>";
            }
        }
    
    ?>

</nav>

    
</body>
</html>

