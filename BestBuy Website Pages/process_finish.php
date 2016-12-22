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


          $username=$_SESSION["username"];
          $transactionID=$_GET["transactionID"];
     
      // get the addressID
      // check whether address is exist
      $sql="update transaction set in_process=1 where transactionID={$transactionID}"; 
//print "<script type='text/javascript'>alert('$sql');location='customer_transaction.php'; </script>";
      $result = $conn->query($sql);

      if($result)
          print "<script type='text/javascript'>alert('Transaction finish!');location='customer_transaction.php'; </script>";
      else
          print "<script type='text/javascript'>alert('Failed, please try again!');location='customer_transaction.php'; </script>";
    
    ?>