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
echo("aaa");

          $storeID=$_SESSION["storeID"];
          $productName=$_POST["productname"];
          $price=$_POST["price"];
          $description=$_POST["description"];
          $brand=$_POST["brand"];
          $category=$_POST["category"];
          $amount=$_POST["inventory"];
          $productID=$_SESSION["productID"];
      // insert into product table
      $sql="update product set gwpname='{$productName}',cost={$price},categoryID={$category},brandID={$brand},description='{$description}' where productID={$productID}";


//    print "<script type='text/javascript'>alert('$sql');location='product_store.php'; </script>"; 

      $result = $conn->query($sql);
      if($result){
          $sql="update storage set amount={$amount} where productID={$productID} and storeID={$storeID}";
          $result = $conn->query($sql);
          if($result)
              print "<script type='text/javascript'>alert('Success!');location='product_store.php'; </script>";
          else
              print "<script type='text/javascript'>alert('Failed!');location='product_store.php'; </script>"; 
      }
              
      else
           print "<script type='text/javascript'>alert('Failed!');location='product_store.php'; </script>";
      
    ?>