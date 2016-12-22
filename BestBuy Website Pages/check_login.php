<?php
    session_start();
    $username=trim($_POST["user"]);
    $password=trim($_POST["password"]);
//    $info="username:".$username." password: ".$password;
//    print "<script type='text/javascript'>alert('$info');location='login.php'; </script>"; 
    if($username==""||$password==""){
        print "<script type='text/javascript'>alert('Please enter both username and password.');location='login.php'; </script>";  
    }
    
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

      $sql="select * from users where userName='{$username}'";

      $result = $conn->query($sql);

      $info = "result:".$row[pass];


    if($result){
        $row = $result->fetch_assoc();
    
    if($row[pass]==$password){  
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = $row[userType];
        
        // different roles will see different page
        if($row[userType]=='admin'){
            print "<script type='text/javascript'>location='adminFrame.html';</script>";
        }
        else if($row[userType]=='bcustomer'||$row[userType]=='hcustomer'){
            print "<script type='text/javascript'>location='MainFrame.html';</script>";  
        }
        else{
            print "<script type='text/javascript'>location='backEndFrame.html';</script>";
        }
        
    }  

    }
   
    print "<script type='text/javascript'>alert('Password is not correct!');location='login.php'; </script>";

    
    ?>