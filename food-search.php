<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

    <?php

        //get the search keyword
        $search=$_POST['search'];

    ?>


        <h2>Foods on Your Search <a href="#" class="text-white">"<?php  echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php

      

        //sql query to get foods based on search keyword
        $sql1 = "SELECT * FROM   tbl_food  WHERE title LIKE  '%$search%' OR description LIKE '%$search%' ";
             //execute the query
         $res1 = mysqli_query($conn, $sql1);

        //count rows to check wheather we have data in database or not
        $count1 = mysqli_num_rows($res1);

        //check the no of rows
          if ($count1 > 0) {
            //we have data in db
            //get the data & display
            while ($rows = mysqli_fetch_assoc($res1)) {

                //get the details
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

                                    <a href="<?php echo  SITEURL; ?>order.php?id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>


                
                <?php

            }
        }
        else {
            //food not available
        
            
                echo "< div class='error'>Food Not Found.</div>";
            
            
        }
            
 

        ?>

        

        

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>