<?php
session_start();
include_once "config.php";

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

if(!empty ($email) && !empty ($password)){
    //chech user entered email and password match
    $sql=mysqli_query($conn,"SELECT * FROM users WHERE email='{$email}' AND password='{$password}'");
    if(mysqli_num_rows($sql)>0){
        $row= mysqli_fetch_assoc($sql);
        $status="Active Now";
        $sql=mysqli_query($conn,"UPDATE users SET status='{$status}' where unique_id={$row['unique_id']}");
         if($sql){
            $_SESSION['unique_id']=$row['unique_id'];//using thie session we used user unique_id in other php file
            echo "success";
         }
      
    }
    else{
        echo "Email or Password is Incorrect";
    }

}else{
    echo "All input field are required!";
}

?>