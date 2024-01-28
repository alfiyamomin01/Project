
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Login </title>

	<link rel="stylesheet" href="css/contact.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
	<div class="container">
    
        <div class="form-box">
            <h1 id="title"> Contact Us</h1>

            <?php
                    if(isset($_SESSION['container']))
                    {
                        echo $_SESSION['container'];
                        unset ($_SESSION['container']);
                    }

                    if(isset($_SESSION['no-login-message']))
                    {
                        echo $_SESSION['no-login-message'];
                        unset ($_SESSION['no-login-message']);
                    }
           ?>

           <th>
            <td>Name : Alifiya Momin <br>
                        Bushra Qureshi
<br>
<br>
                Email : alfiyamomin43@gmail.com /
                <br>      food-order11@gmail.com
<br>
<br>
                Contact : 9890650132 / 97630393212
        </td>
           </th>
              <!-- <form action=""  method="POST">

                    <div class="input-group">
                        <div class="input-field" id="nameField">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <input type="username" name="username" placeholder="Enter Your Name">
                        </div>

                        <div class="input-group">
                        <div class="input-field" id="nameField">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <input type="username" name="username" placeholder="Enter Your Email">
                        </div>

                        <div class="input-field">
                            <ion-icon name="key-outline"></ion-icon>
                            <input type="password" name="password" placeholder="Enter Password">
                        </div>
                    </div>

                    <div class="btn-field">
                        <button type="submit" name="submit" >Login</button>
                    </div>
            </form> -->
        </div>
    </div>

    </body>
</html>

<?php
    
    //check wheather the submit button is click or not
    if (isset($_POST['submit']))
    {
        //process of login

        //get the data from loginform
         $username= $_POST['username'];
         $password= md5($_POST['password']);

         //sql to check the user with username and pass exist or not
         $sql = "SELECT * FROM tb1_admin WHERE username='$username' AND password='$password'";

         //execute the query
         $res = mysqli_query($conn, $sql);

         //count the rowsto check the user is exist or not
         $count = mysqli_num_rows($res);

         if($count==1)
         {
            //user available
            $_SESSION['container']="<div class='succes'>LOGIN SUCCESSFUL </div>";
            $_SESSION['user'] = $username; //to check wheter the user is login or not and logout will unset it

            //redirect to home page
            header('location:'.SITEURL.'admin/');
         }
         else{
            //user not available
            $_SESSION['container']="<div class='error'>FAILED TO LOGIN </div>";
            //redirect to home page
            header('location:'.SITEURL.'admin/login.php');
         }
    }


?>