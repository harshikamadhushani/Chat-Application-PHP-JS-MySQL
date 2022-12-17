<?php
session_start();
if(isset($_SESSION['unique_id'])){// id user is logged in
    header("location: users.php");
}
?>

<?php include_once "header.php"; ?>

 <body>
   <div class="wrapper">
    <section class="form login">
     <header>Realtime Chat Appliction</header>
     <form action="#">
        <div class="error-txt"></div>
        
            <div class="field input">
                <label>Email Address</label>
                <input type="text" name="email" placeholder="Enter Your Email">
            </div>
            <div class="field input">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter Your Password">
                <i class="fas fa-eye"></i>
            </div>
           
            <div class="field button">
                <input type="submit" value="Continue To Chat">
            </div>
       

     </form>
     <div class="link">Not Yet Signed Up?<a href="Home.php">Signup</a></div>
    </section>


   </div>

   <script src="Javascript/pass-show-hide.js"></script>
   <script src="Javascript/login.js"></script>
 </body>
</html>