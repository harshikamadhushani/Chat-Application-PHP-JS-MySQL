<?php
session_start();
  include_once "config.php";
  $fname = mysqli_real_escape_string($conn,$_POST['fname']);
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
   
  if(!empty($fname) && !empty($lname) && !empty($email)&& !empty($password)){
    //Check user email is valid or not
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){//if email is valid
     // check that email already exist
     $sql=mysqli_query($conn,"SELECT email FROM users WHERE email='{$email}'");
     if(mysqli_num_rows($sql)>0){// if email already exist
        echo "$email - This Email already exit!";
     }else{
         // chech user upload file or not
         if(isset($_FILES['image'])){
            $img_name=$_FILES['image']['name'];// getting user uploaded image name
            $img_type = $_FILES['image']['type'];
            $tmp_name=$_FILES['image']['tmp_name'];// this tempoty name is used to save/move file in our folder
            
            //explode image and get the last extension like jpg png
            $img_explode= explode('.',$img_name);
            $img_ext = end($img_explode); // get the extension of an user uploaded image file

            $extensions=["png","jpeg","jpg"];

            if(in_array($img_ext, $extensions)===true){
                $time=time();// this will return current time
                $new_img_name=$time.$img_name;

                if(move_uploaded_file($tmp_name,"Image/".$new_img_name)){
                    $random_id=rand(time(),100000000);
                    $status="Active Now";
                    

                    //insert all user data inside table
                    $sql2=mysqli_query($conn,"INSERT INTO users(unique_id,fname,lname,email,password,img,status)
                    VALUES({$random_id},'{$fname}','{$lname}','{$email}','{$password}','{$new_img_name}','{$status}')");
                  
                  if($sql2){//if these data inserted
                    $sql3=mysqli_query($conn, "SELECT * FROM users where email ='{$email}'");
                    if(mysqli_num_rows($sql3)>0){
                        $row=mysqli_fetch_assoc($sql3);
                            $_SESSION['unique_id']=$row['unique_id'];//using thie session we used user unique_id in other php file
                            echo "success";
                    }
                  }
                  else{
                    echo "Something went wrong!";
                  }
                }
                
            }
            else{
                echo "plase select an image file - jpeg, jpg, png!";
            }
         }else{
            echo "Please Select an Image";
         }
     }
    }else{
        echo "$email - This is not a Valid Email";
    }
    
  }else{
    echo "All input field are Required!";
  }
  ?>