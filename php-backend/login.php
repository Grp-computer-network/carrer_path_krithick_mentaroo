<?php
session_start();
 if($_SERVER['REQUEST_METHOD']=='POST')
 {
    $servername="localhost";
    $username="root";
    $password="krithick@1234";
    $db_name="task_1";

    $conn = new mysqli($servername,$username,$password,$db_name);
    if($conn->connect_error){
        die("connection failed :".$conn->connect_error);
    }

    $input1_username=$_POST['username'];
    $input1_password=$_POST['password'];
    $stmt=$conn->prepare("SELECT id,password FROM sign_up where username= ?");
    $stmt->bind_param("s",$input1_username);
    $stmt->execute();
    $stmt->bind_result($user_id,$hashed_password);
    $stmt->fetch();
    $stmt->close();

    if(password_verify($input1_password,$hashed_password)){
        $_SESSION['user_id']=$user_id;
        header('Location:dashboard.php');
        exit();
    }
    else{
        echo "Invalid login Credentials!";
    }
    $conn->close();
 }
?>
