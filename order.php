
    <?php include('partials-frontend/menu.php');  ?>
    <link rel="stylesheet" href="css/order.css">
<?php 

        //chck the food id is sset or not
        if(isset($_GET['food_id']))
        {
            //get the food it and details of the selected food
            $food_id=$_GET['food_id'];

            //get the deatils of the selectted food
            $sql = "SELECT * FROM `tbl_food` WHERE id=$food_id";

            //execute the query 
            $res = mysqli_query($conn, $sql);

            //count the rows and check the data is available or not
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                    //we have data
                    //get the data from db
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
            }
            else{
                    //food not available redirect to home page 
                    header('location:'.SITEURL.'index.php');

            }

        }
        else{
                //redirect to home page
                header('location:'.SITEURL.'index.php');
        }
?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

    
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php 
                                //check img is available or not
                                if($image_name=="")
                                {
                                    //img not available
                                    echo "<div class='error'> Image Not Available.</div>";
                                }
                                else{
                                        //img is available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/food/<?php echo $image_name;  ?>" class="img-responsive img-curve">
                                    
                                    <?php
                                       
                                }

                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Yous Name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder=" 9890xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder=" abc@gamil.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder=" Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="pay" value="Payment" class="btn btn-primary">
                    
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

                </fieldset>

            </form>
           
            <?php
            
                        //check where the submit btn is clicked or not
                        if(isset($_POST['submit']))
                        {
                            //get all the details from the form 
                            $food = $_POST['food'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $total = $price * $qty;
                            $order_date = date("Y-m-d h-i-sa");
                            $status = "Ordered";
                            $customer_name = $_POST['full-name'];
                            $customer_contact = $_POST['contact'];
                            $customer_email = $_POST['email'];
                            $customer_address = $_POST['address'];

                            //set the order in db
                            $sql2 = "INSERT INTO `tbl_order` SET
                                    food = '$food',
                                    price = $price,
                                    qty = $qty,
                                    total = $total,
                                    order_date = $order_date,
                                    status = '$status',
                                    customer_name = '$customer_name',
                                    customer_contact = '$customer_contact',
                                    customer_email = '$customer_email',
                                    customer_address = '$customer_address'
                                    ";

                                    //execute the query
                                    $res2 = mysqli_query($conn, $sql2);

                                    //check the query execute or not
                                    if($res2)
                                    {
                                        //query execute and save in db
                                        $_SESSION['order'] = "<div class='succes'>Order Successfully.</div>";
                                        // header('location:'.SITEURL.'index.php');
                                        
                                        ?>

                 <script>
                        window.location.href='index.php';
                    </script> 
    
                    <?php
                                    }
                                    else{
                                            //failed to save
                                            $_SESSION['order'] = "<div class='error'>Failed to Order.</div>";
                                            // header('location:'.SITEURL.'index.php');
?>
                 <script>
                        window.location.href='index.php';
                    </script> 
                    
                    <?php
                                    }
                        }
            ?>
    </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-frontend/footer.php'); ?>
