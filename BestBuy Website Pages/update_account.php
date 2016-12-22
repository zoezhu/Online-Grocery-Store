<?php
    session_start();
    $username=$_SESSION['username'];
    $userType=$_SESSION['userType'];

// connect database
        $servername = $_SESSION["servername"];
        $dbusername = $_SESSION["dbusername"];
        $dbpassword = $_SESSION["dbpassword"];
        $database = $_SESSION["database"];
        $conn = new mysqli($servername, $dbusername, $dbpassword, $database);
    
//print "<script type='text/javascript'>alert('$dbusername');location='MainFrame.html'; </script>";
        
        // check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
       } 
        
        $first_name=trim($_POST["first_name"]);
        $last_name=trim($_POST["last_name"]);        
        $city=trim($_POST["city"]);
        $street=trim($_POST["street"]);
        $apartment=trim($_POST["apartment"]);
        $pwd=trim($_POST["pwd"]);
        $tel=trim($_POST["tel"]);
        $email=trim($_POST["email"]);


       // update fileds specify in hcustomer
       if($userType=="hcustomer"){       
           $gender=trim($_POST["gender"]);
           $birth_date=trim($_POST["birth_date"]);
           $income=trim($_POST["income"]);
           $marrige_status=trim($_POST["marrige_status"]);

           $sql="update hcustomer set first_name='{$first_name}',last_name='{$last_name}',gender='{$gender}',birth_date='{$birth_date}',income={$income},marriage_status='{$marrige_status}',pass='{$pwd}',tel='{$tel}',email='{$email}' where h_customerUsername='{$username}'";
//           print "<script type='text/javascript'>alert('$sql');location='update_account.php'; </script>";
       }
       //update fileds specify in bcustomer
        else{
            $business_category=trim($_POST["business_category"]);
            $company_gai=trim($_POST["company_gai"]);
            
            $sql="update bcustomer set first_name='{$first_name}',last_name='{$last_name}',business_category='{$business_category}',company_GAI={$company_gai},pass='{$pwd}',tel='{$tel}',email='{$email}' where b_customerUsername='{$username}'";
        }
        $result = $conn->query($sql);

      // update table customer & users
        $sql="update custoer set pass=\'{$pwd}\' where customerName=\'{$username}\'";
        $result=$conn->query($sql);
        $sql="update users set pass='{$pwd}' where userName='{$username}'";
        $result=$conn->query($sql);
    

     // deal with address
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

//print "<script type='text/javascript'>alert('here!!');location='MainFrame.html'; </script>";

      // insert into hcustomer
      if($userType=="hcustomer")
        $sql="update hcustomer set addressID='{$addressID}' where h_customerUsername='{$username}'";
      // insert into bcustomer
      else
        $sql="update bcustomer set addressID='{$addressID}' where b_customerUsername='{$username}'";
      $result = $conn->query($sql);
      if($result){
        print "<script type='text/javascript'>alert('Success!');location='account_view.php'; </script>";
      }


    ?>