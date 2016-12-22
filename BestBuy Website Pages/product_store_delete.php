<?php
    session_start();
    
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


      $productID=$_GET["productID"];
      $storeID=$_SESSION["storeID"];
     
      $sql="delete from storage where storeID={$storeID} and productID={$productID}";

      $result = $conn->query($sql);
      if($result)
          print "<script type='text/javascript'>alert('Delete success!');location='product_store.php'; </script>";
       else
           print "<script type='text/javascript'>alert('Failed!');location='product_store.php'; </script>";
    
    ?>