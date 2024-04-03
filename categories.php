<?php include('partials-front/menu.php'); ?>




<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        //create sql query to display categories from database
             //query to get all categories from db
             $sql = "SELECT * FROM   tbl_category  WHERE active='yes'";
             //execute the query
             $res = mysqli_query($conn, $sql);
 
             //count rows to check wheather we have data in database or not
             $count = mysqli_num_rows($res);
             
                 //check the no of rows
            if ($count > 0) {
                //we have data in db
                //get the data & display
                while ($rows = mysqli_fetch_assoc($res)) {
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    ?>

                    <a href="category-foods.html">
                        <div class="box-3 float-container">
                            
                        <?php
                            //check wheather image available or not
                            if($image_name != ""){
                                //Display the Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  alt="Pizza" class="img-responsive img-curve">
                            <?php
                            } else {
                                //Display the message
                                echo "<div class='error'>Image not Available.</div>";
                            }
                              
                        ?>

                         

                            <h3 class="float-text text-white"><?php  echo $title; ?></h3>
                        </div>
                     </a>



                    <?php
                }
            }
            else {
                //category not available
            
                
                    echo "< div class='error'>No Category found.</div>";
                
                
            }

            

        ?>

      
       
        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<?php include('partials-front/footer.php'); ?>