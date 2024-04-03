<?php include('partials-front/menu.php'); ?>

<?php 
//$id=$GET['$id'];
//check wheather food is set or not 
//if(isset($_GET['$id']))
//{
    //get the food id and details of the food
     //1.get the id of admin to be selected
     $id = $_GET['id'];

     //2.create a sql query to get the selected admin details
     $sql = "SELECT * FROM tbl_food WHERE id=$id";

     //execute the query
     $res = mysqli_query($conn, $sql);
     

    
    //$sql="SELECT * FROM  tbl_food WHERE  id=$id";
   // Execute the query
   //$res=mysqli_query($conn,$sql);
   //count the rows
   $count=mysqli_num_rows($res);
   //check the wheather data is available or not
   if($count==1)
   {
    //we have data
    //get the data from  database
  $rows = mysqli_fetch_assoc($res);

    //$rows = mysqli_fetch_assoc($res);

    $title = $rows['title'];
   $price = $rows['price'];
   $image_name = $rows['image_name'];
   

    }
  else{
    //redirect food not available 
    //redirect to home page
    header('location:'.SITEURL);
   }

//else{
    //redirect to home page
   // header('location:'.SITEURL);
  
//}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" method="post" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    
                   
                    <?php
                    //check wheather the  image name is  available or not
                    if ($image_name != "") {
                        //Display the Image
                    ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    <?php
                    } else {
                        //Display the message
                        echo "<div class='error'>Image not Added.</div>";
                    }

                    ?>
                    
                </div>

                <div class="food-menu-desc">
                    <h3><?php  echo $title; ?></h3>
                    <input type="hidden" name ="food" value="<?php echo $title;?>">

                    <p class="food-price">Rs.<?php  echo $price; ?></p>
                    <input type="hidden" name ="price" value="<?php echo $price;?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Pundalik_Desai" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 7820xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. desaipundalik4@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php

       // check whether submit button clicked or not 

       if (isset($_POST['submit'])) {

        //echo "button clicked";
        //get all the values form form to update
        $food= $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total=$price *$qty;   //total =price*qty
        $order_date =date("Y-m-d h:i:sa");  //order date

        $status="ordered";  //ordered ,ondelivery,Delivered ,Cancalled

        $customer_name= $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email= $_POST['email'];
        $customer_address = $_POST['address'];

        //save the order in database 
        //create sql to save data

        $sql2="INSERT INTO tbl_order SET
             food='$food',
             price='$price',
             qty='$qty',
             total='$total',
             order_date='$order_date',
             status='$status',
             customer_name='$customer_name',
             customer_contact='$customer_contact',
             customer_email= '$customer_email',
             customer_address= '$customer_address'
             ";


             //execute the query
              //execute the query
            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
             
            //check wheather query executed successfully or not
            if ($res2 == TRUE) {
                
                $_SESSION['order'] = "<div class='success text-center'> <h3>Food order Successfully.</h3></div>";
               
                header("location:" . SITEURL );
            } else {
                //failed to Save order
              
                $_SESSION['order'] = "<div class='error text-center'>Failed to order food . try again later.</div>";
                
                header("location:" . SITEURL);
            }

           }    ?>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->


<?php include('partials-front/footer.php'); ?>