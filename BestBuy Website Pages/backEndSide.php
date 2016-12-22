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

<!--List for my store-->
<!-- Sidenav -->
<nav class="w3-sidenav w3-theme-l5 w3-animate-left" style="z-index:3;width:250px;" id="side">
    <h4><b>My Store</b></h4>
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
      
        $username = $_SESSION["username"];
        $userType = $_SESSION["userType"];
    
       // run a sql
        if($userType=="store_manager"){
            $sql="select count(*) as c from store where storeManagerName='{$username}'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $store_count = $row[c];
            $sql="select * from store where storeManagerName='{$username}'";
        }
        else{
            $sql="select count(*) as c from store s,region r where s.regionID=r.regionID and r.regionManagerName='{$username}'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $store_count = $row[c];
            $sql="select * from store s,region r where s.regionID=r.regionID and r.regionManagerName='{$username}'";
        }
                
    
//         print "<script type='text/javascript'>alert('$store_count');location='backEndSide.php'; </script>"; 
    
        $my_store=array();
        $i=0;
        $result = $conn->query($sql);
        if($result)
        {
            while($row = $result->fetch_assoc())
            {
                print "<a href=\"product_store.php?storeID={$row[storeID]}\" class=\"w3-hover-black\" target=\"main\">{$row[storeName]}</a>";
                $my_store[]=$row[storeID];
            }
        }
    
    
//    for($i=0;$i<$store_count;$i++)
//        print "$my_store[$i]";

        
        // other store
        print "<h4><b>Other Store</b></h4>";
        // run a sql
        $sql="select * from store"; 
        $result = $conn->query($sql);

        if($result)
        {
            while($row = $result->fetch_assoc())
            {
                $is_my_store = False;
                // not my store
                for($i=0;$i<$store_count;$i++)
                    if($my_store[$i]==$row[storeID]){
                        $is_my_store = True;
                        break;
                    }
                        
                if(!$is_my_store)
                    print "<a href=\"product_store_view.php?storeID={$row[storeID]}\" class=\"w3-hover-black\" target=\"main\">{$row[storeName]}</a>";
            }
        }  
    ?>

</nav>
    
    
</body>
</html>

