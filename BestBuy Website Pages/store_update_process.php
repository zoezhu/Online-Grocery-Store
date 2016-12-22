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


          $storeID=$_SESSION["storeID"];
          $storename=$_POST["storename"];
          $region=$_POST["region"];
          $storeManager=$_POST["storeManager"];
          $city=$_POST["city"];
          $street=$_POST["street"];
     
      // get the addressID
      // check whether address is exist
      $sql="select * from address a where a.cityName='{$city}' and a.zip_code='{$street}'"; 
      $result = $conn->query($sql);


      
      if($result){
          $row = $result->fetch_assoc();
          // if exist, just read the addressID
          if($row){
              $addressID = $row[addressID];
          }
      
          // if not exist, insert this new address
          else{
              $sql="insert into address values(null,'{$city}','{$street}','{$apartment}')";
              $result = $conn->query($sql);
              $sql="select MAX(addressID) as m from address";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              $addressID = $row[m];  
          }
      }

      $sql="update store set storeName='{$storename}',regionID={$region},storeManagerName='{$storeManager}',addressID={$addressID} where storeID={$storeID}";

      $result = $conn->query($sql);
      if($result)
          print "<script type='text/javascript'>alert('Update success!');location='admin_table_store.php'; </script>";
    
    ?>