<!-- connection of sql -->
<?php include('config/constant.php');
       include('partials-frontend/c-login-check.php');
       
?>  


<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Customer-Login</title>

	<!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/c_login.css">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
	<div class="container">
        <div class="form-box">
            <h1 id="title"> Login </h1>

            <?php

                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'] ))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']); 
                }
            ?>


            <form action="" method="POST">

                <div class="input-group">
                
                    <div class="input-field">
                      <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="username" placeholder="Enter Username">
                    </div>

                    <div class="input-field">
                        <ion-icon name="key-outline"></ion-icon>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    
                    <div class="btn-field">
                        <button type="submit" name="submit" >Login</button>
                    </div>

                    <p>If Not Register please <a href='register.php'>Register here.</a> </p>
                    <!-- <button type="button" id="signinBtn" class="disable" > Sign in</button> -->
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php 

            //chck the btn is clicked or not
           //check wheather the submit button is click or not
    if (isset($_POST['submit']))
    {
        //process of login

        //get the data from loginform
         $username= $_POST['username'];
         $password= md5($_POST['password']);

         //sql to check the user with username and pass exist or not
         $sql = "SELECT * FROM tbl_customer WHERE username='$username' AND password='$password'";

         //execute the query
         $res = mysqli_query($conn, $sql);

         //count the rowsto check the user is exist or not
         $count = mysqli_num_rows($res);

         if($count==1)
         {
            //user available
            $_SESSION['login']="<div class='succes' text-center>LOGIN SUCCESSFUL </div>";
            $_SESSION['user'] = $username; //to check wheter the user is login or not and logout will unset it

            //redirect to home page
            header('location:'.SITEURL.'index.php');
         }
         else{
            //user not available
            $_SESSION['login']="<div class='error' text-center>FAILED TO LOGIN </div>";
            //redirect to home page
            header('location:'.SITEURL.'c_login.php');
         }
    }

?>