<?php include('config/constant.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Registration</title>

	<!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="css/c_login.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
	<div class="container">
        <div class="form-box">
            <h1 id="title"> Registration </h1>

            <?php

                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }
            ?>
            
            <form action=" "  method="POST">

                <div class="input-g">
                    <div class="input-field" id="nameField">
                        <ion-icon name="person-circle-outline"></ion-icon>
                        <input type="text" name="full_name" placeholder="Enter Your Full-Name">
                    </div>
                    
                    <div class="input-field">
                    <ion-icon name="call-outline"></ion-icon>
                        <input type="text" name="username" placeholder="username">
                    </div>


                    <div class="input-field">
                    <ion-icon name="call-outline"></ion-icon>
                        <input type="number" name="contact" placeholder="9890*****">
                    </div>

                    <!-- <div class="input-field">
                        <ion-icon name="mail-outline"> </ion-icon>
                        <input type="email" name="email" placeholder="abc@gmail.com/yahoo">
                    </div> -->

                    <div class="input-field">
                     <ion-icon name="location-outline"></ion-icon>
                        <input type="text" name="address" placeholder="Location">
                    </div>

                    <div class="input-field">
                        <ion-icon name="key-outline"></ion-icon>
                        <input type="password" name="password" placeholder="Password">
                    </div>
                    <!-- <p>Forgate Password <a href="C:/Users/alfiy/OneDrive/Desktop/OwnPro/Forgatepass.html">click here!</a> </p> -->

                </div>
        
                <div class="btn-field">
                        <button type="submit" name="submit" >Login</button>
                    </div>
            </form>
        </div>
    </div>

</body>
</html>

<?php 
    //  process the value of add and save in db


    if(isset($_POST['submit']))
    {
        // button click
        // echo "Button Click";

        // 1.get the data from user
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $contact = $_POST['contact'];
        // $email = $_POST['email'];
        $address = $_POST['address'];
        $password = md5($_POST['password']);  //password encryption with md5

            //2.sql query to save the data into db
            $sql = "INSERT INTO tbl_customer SET
                        full_name = '$full_name',
                        username = '$username',
                        contact = $contact,
                        address = '$address',
                        password = '$password'
                    ";        
                    // echo $sql;


            //execute query and save data in db
            $res = mysqli_query($conn, $sql)or die(mysqli_error($conn));

            //check whether the query is executing data is inserted or not and display message
            if($res==TRUE)
            {
                //data insert
                // echo "Data inserted...";

            
                $_SESSION['add'] = "<div class='succes'>Registration Sucessfully.</div>";
                header("location:".SITEURL.'c_login.php');
            }
            else{
                //faild to insertt data

                $_SESSION['add'] =  "<div class='error'>Failed to Registration. Try Again later.</div>";
                header("location:".SITEURL.'index.php');
            }
        }
       
?>