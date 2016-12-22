<?php
    session_start();
    $gender=trim($_POST["gender"]);
    $birth_date=trim($_POST["birth_date"]);
    $income=trim($_POST["income"]);
    $marrige_status=trim($_POST["marrige_status"]);
    $city=trim($_POST["city"]);
    $street=trim($_POST["street"]);
    $apartment=trim($_POST["apartment"]);

//    print "<script type='text/javascript'>alert('{$apartment}'); </script>"; 

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

//print "<script type='text/javascript'>alert('{$first_name}'); </script>"; 

     
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


      // insert into hcustomer
      $sql="insert into hcustomer values('{$user_name}','{$first_name}','{$last_name}','{$gender}','{$birth_date}',{$income},'{$marrige_status}',{$addressID},'{$pwd}','{$email}','{$tel}')";
//print "<script type='text/javascript'>alert('{$sql}'); </script>"; 
      $result = $conn->query($sql);
      if($result){
          print "<script type='text/javascript'>alert('Success!');location='login.php'; </script>";
      }
    
    ?>