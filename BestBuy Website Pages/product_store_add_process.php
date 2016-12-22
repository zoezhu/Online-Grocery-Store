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
          $productName=$_POST["productName"];
          $price=$_POST["price"];
          $category=$_POST["category"];
          $brand=$_POST["brand"];
          $description=$_POST["description"];
          $amount=$_POST["amount"];
      // insert into product table
      $sql="insert into product values(null,'{$productName}',{$price},{$category},{$brand},'{$description}')";


//    print "<script type='text/javascript'>alert('$sql');location='product_store.php'; </script>"; 

      $result = $conn->query($sql);
      if($result){
          // get the productID
          $sql = "select max(productID) as m from product";
          $result = $conn->query($sql); 
          $row = $result->fetch_assoc();
          $productID = $row[m];
          
          // insert into storage table
          $sql="insert into storage values({$productID},{$storeID},{$amount})";
// print "<script type='text/javascript'>alert('$sql');location='product_store.php'; </script>"; 
          
          $result = $conn->query($sql);

          if($result)
              print "<script type='text/javascript'>alert('Update success!');location='backEndMain.php'; </script>";
          else
              print "<script type='text/javascript'>alert('2Failed!');location='backEndMain.php'; </script>";
          
      }
      else
           print "<script type='text/javascript'>alert('Failed!');location='backEndMain.php'; </script>";
      
    ?>