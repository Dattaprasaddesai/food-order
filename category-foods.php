<?php include('partials-front/menu.php'); ?>

<?php
//check wheather the id is passed or not
if(isset($_GET['id']))
{
    //category id is set and get the id
    $id=$_GET['id'];

    //get the category title based on category id
    $sql = "SELECT title FROM   tbl_category  WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //get the values from db
    $rows = mysqli_fetch_assoc($res);

    //get the title
    $category_title=$rows['title'];

 

}
else
{
    //category not passed
    //redirect to home page
    header('location:'.SITEURL);
}

?>



<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php  echo $category_title; ?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php
        //create a sql query  to gets foods based on selected category
        $sql2="SELECT * FROM   tbl_food  WHERE category_id=$id";

        //execute the query
        $res2 = mysqli_query($conn, $sql2);

         //count rows to check wheather we have data in database or not
         $count2= mysqli_num_rows($res2);

         if ($count2 > 0) {
            //we have data in db
            //get the data & display
            while ($rows2 = mysqli_fetch_assoc($res2)) {

                //$id = $rows['id'];
                $id=$rows2['id'];
                $title = $rows2['title'];
                $price = $rows2['price'];
                $description = $rows2['description'];
                $image_name = $rows2['image_name'];
                ?>
                        <div class="food-menu-box">
                        <div class="food-menu-img">

                        <?php
                        //check wheather image available or not

                         if($image_name != ""){
                            //Display the Image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
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

                                    <a href="<?php echo  SITEURL; ?>order.php?id=<?php echo $id; ?>"class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                    

                <?php

            }
        }

         else {            //category not available
        
            
                echo "food not available";
               
            
        }






        ?>



        

        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>