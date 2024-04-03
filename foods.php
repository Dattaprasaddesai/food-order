<?php include('partials-front/menu.php'); ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL;?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>





        <?php
        //create sql query to display food from database
             //query to get all food from db
             $sql2 = "SELECT * FROM   tbl_food  WHERE active='Yes' LIMIT  6";
             //execute the query
             $res2 = mysqli_query($conn, $sql2);
 
             //count rows to check wheather we have data in database or not
             $count1 = mysqli_num_rows($res2);
              //check the food available or not=
            if ($count1> 0) {
                //we have data in db
                //get the data & display
                while ($rows = mysqli_fetch_assoc($res2)) {

                    //get all the values
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price = $rows['price']; 
                    $description = $rows['description'];
                    $image_name = $rows['image_name'];
                    ?>

                    
                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php
                                    //check wheather image available or not

                                    if($image_name != ""){
                                        //Display the Image
                                    ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken  Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                    } else {
                                        //Display the message
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    
                                    
                                    ?>


                            
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php  echo $title; ?></h4>
                                    <p class="food-price">Rs.<?php  echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php  echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="order.php" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>


                    <?php




                }
            }
            else {
                        //category not available
                    
                        
                            echo "< div class='error'>No, Food not available.</div>";
                        
                        
                    }
        ?>





      

        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="#">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->




<?php include('partials-front/footer.php'); ?>