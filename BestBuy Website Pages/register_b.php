<?php
    session_start();
    $business_category=trim($_POST["business_category"]);
    $company_gai=trim($_POST["company_gai"]);
    $city=trim($_POST["city"]);
    $street=trim($_POST["street"]);
    $apartment=trim($_POST["apartment"]);

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
       
      $first_name=$_SESSION["first_name"];
      $last_name=$_SESSION["last_name"];
      $user_name=$_SESSION["user_name"];
      $pwd=$_SESSION["pwd"];
      $email=$_SESSION["email"];
      $tel=$_SESSION["tel"];
   
     
      // check whether address is exist
      $sql="select * from address a where a.cityName='{$city}' and a.zip_code='{$street}' and a.apartment='{$apartment}'";
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

      // insert into bcustomer
      $sql="insert into bcustomer values('{$user_name}','{$first_name}','{$last_name}','{$business_category}',{$company_gai},{$addressID},'{$pwd}','{$email}','{$tel}')";

      $result = $conn->query($sql);
      if($result){
          print "<script type='text/javascript'>alert('Success!');location='login.php'; </script>";
      }
    
    ?>