<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $servername="localhost";
    $username="root";
    $password="krithick@1234";
    $db_name="task_1";

    $conn = new mysqli($servername,$username,$password,$db_name);
    if($conn->connect_error){
        die("connection failed :".$conn->connect_error);
    }

    $input_username=$_POST['username'];
    $input_email=$_POST['email'];
    $input_number=$_POST['number'];
    $input_password=$_POST['password'];

    $hased_password=password_hash($input_password,PASSWORD_DEFAULT);

    $stmt= $conn->prepare("INSERT INTO SIGN_UP (USERNAME,EMAIL,PHONE,PASSWORD) values (?,?,?,?)");
    if($stmt === false){
        die("prepare failed" . $conn->error);
    }
    $stmt->bind_param("ssss",$input_username,$input_email,$input_number,$hased_password);
    if($stmt->execute()){
        echo "Resistration sucessfully";
    }
    else{
        echo "Errorr". $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
else{
    echo "invalid  ";
}

?>