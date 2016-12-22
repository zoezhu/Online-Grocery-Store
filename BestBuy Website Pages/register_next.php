<?php
    session_start();
    $user_type=trim($_POST["user_type"]);
    $first_name=trim($_POST["first_name"]);
    $last_name=trim($_POST["last_name"]);
    $user_name=trim($_POST["user_name"]);
    $pwd=trim($_POST["pwd"]);
    $email=trim($_POST["email"]);
    $tel=trim($_POST["tel"]);

//    print "<script type='text/javascript'>alert('{$user_type}');location='create_account.php'; </script>"; 

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

     
      // check username
      $sql="select userName from users where userName='{$user_name}'";

      $result = $conn->query($sql);


    if($result){
        $row = $result->fetch_assoc();
    
        if($row){  

            print "<script type='text/javascript'>alert('Username has been used!');location='create_account.php';</script>";  
            }  
    

        else{
            $_SESSION["first_name"]=$first_name;
            $_SESSION["last_name"]=$last_name;
            $_SESSION["user_name"]=$user_name;
            $_SESSION["pwd"]=$pwd;
            $_SESSION["email"]=$email;
            $_SESSION["tel"]=$tel;

            if($user_type=="home"){
                print "<script type='text/javascript'>location='create_account_h.php';</script>";
            }
            else{
                print "<script type='text/javascript'>location='create_account_b.php';</script>";
            }
        }
        
    }


    ?>