<?php include('partials-frontend/menu.php'); ?>

    <!-- fOOD search  Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
        <?php

                //get the search kryword
            
                // $search = $_POST['search'];   
                $search = mysqli_real_escape_string($conn, $_POST['search']);
               
        ?>
            <h2> Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

    
            <?php 

                   //disply foods that are active
                   //$search = burger '; DROP database name;
                   //"SELECT * FROM tbl_food WHERE totle LIKE '%burger'%' OR description LIKE '%burger'%'";
                   $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows the food items
                    $count= mysqli_num_rows($res);

                    //chcek food available or not
                    if($count>0)
                    {
                        //food available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get th details
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $description = $row['description'];
                            $image_name = $row['image_name'];

                            ?>

                            
                             <div class="food-menu-box">
                                 <div class="food-menu-img">
                                <?php 
                                
                                        if($image_name=="")
                                        {
                                            //img not available
                                            echo "<div class='error'> Image Not Available.</div";
                                        }
                                        else{
                                                //img available
                                                ?>

                                                    <img src="<?php echo SITEURL; ?>images/category/food/<?php echo $image_name; ?>" class="img-responsive img-curve">

                                                <?php
                                        }
                                ?>
                                     
                                 </div>

                                  <div class="food-menu-desc">
                                        <h4><?php echo $title; ?> </h4>
                                        <p class="food-price"><?php echo $price; ?> </p>
                                        <p class="food-detail">
                                             <?php echo $description; ?> 
                                        </p>
                                        <br>

                                        <a href="#" class="btn btn-primary">Order Now</a>
                                   </div>
                              </div>
                    

                        <?php
                    }
                }
                else{
                        //not available
                        echo "<div class='error'>Food Not Found.</div>";
                }

            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-frontend/footer.php'); ?>