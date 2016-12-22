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
      $username=$_GET['usrname'];
      $sql="delete from users where userName='{$username}'";
      $result1 = $conn->query($sql);
      $sql="delete from bcustomer where b_customerUsername='{$username}'";
      $result2 = $conn->query($sql);
      $sql="delete from hcustomer where h_customerUsername='{$username}'";
      $result3 = $conn->query($sql);
      $sql="delete from salesperson where salespersonName='{$username}'";
      $result4 = $conn->query($sql);
      $sql="delete from customer where customerName='{$username}'";
      $result5 = $conn->query($sql);

      if($result1 & $result2 &$result3 & $result4 & $result5)
          print "<script type='text/javascript'>alert('Delete successful!');location='admin_table_user.php'; </script>";    

    ?>