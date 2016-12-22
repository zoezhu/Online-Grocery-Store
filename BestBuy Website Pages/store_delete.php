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


          $storeID=$_GET["storeID"];
     
      $sql="delete from store where storeID={$storeID}";

      $result = $conn->query($sql);
      if($result)
          print "<script type='text/javascript'>alert('Delete success!');location='admin_table_store.php'; </script>";
    
    ?>