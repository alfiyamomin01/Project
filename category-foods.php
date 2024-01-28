<?php include('partials-frontend/menu.php'); ?>

<?php 
        //checj id is passes or not
        if(isset($_GET['category_id']))
        {
            //category id id set and get id
            $category_id = $_GET['category_id'];

            //get the category title base on cat id
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //execute query
            $res = mysqli_query($conn, $sql);

            //get the value from db
            $row=mysqli_fetch_assoc($res);

            //get the title
            $category_title = $row['title'];
        }
        else{
                //category not pass then redirect to home pg
                header('location:'.SITEURL);
        }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

            //crete sql query based on selected cate
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //count the rows
            $count = mysqli_num_rows($res2);
            
            //check food is available or not
            if($count>0)
            {
                //food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];

                    ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                <?php 

                                            // check img is available or not
                                                    if($image_name=="")
                                                    {
                                                        //img is not available
                                                        echo "<div class='error'>Image is Not Available.</div>";
                                                    }
                                                    else{
                                                            //img available
                                                            ?>

                                                                <img src="<?php echo SITEURL;?>images/category/food/<?php echo $image_name; ?>" class="img-responsive img-curve"> 

                                                            <?php
                                                    }
                                            ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <p class="food-detail">
                                         <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>

                    <?php
                    
                }

            }
            else{
                    //not available
                    echo "<div class='error'>Food Not Available</div>";
            }


            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-frontend/footer.php'); ?>