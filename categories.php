<?php include('partials-frontend/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 

                    //disply all the categories with is active
                    //sql query
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    //execute query
                    $res = mysqli_query($conn, $sql);

                    //count the rows
                    $count = mysqli_num_rows($res);

                    //chck category id available or not
                    if($count>0)
                    {
                        //category available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get all the value
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>

                                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                <?php 
                                
                                        if($image_name=="")
                                        {
                                            //img not available
                                            echo "<div class='error'> Image Not Found.</div";
                                        }
                                        else{
                                                //img available
                                                ?>

                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">

                                                <?php
                                        }
                                ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                                </a>

                            <?php
                        }
                    }
                    else{

                            //not available
                            echo "<div class='error'> Category Not Found.</div";
                    }

            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-frontend/footer.php'); ?>