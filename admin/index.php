<?php include('partials/menu.php'); ?>

<!--Main Content section Starts--->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login']; //displaying session message
            unset($_SESSION['login']); //removing session message

        }
        ?>
        <br><br>
       

        <div class="col-4 text-center">
            <?php

             //query to get all categories from db
            $sql = "SELECT * FROM   tbl_category";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows to check wheather we have data in database or not
            $count = mysqli_num_rows($res);

            ?>
            <h1><?php echo $count ?></h1>
            <br>
            Categories
        </div>

        <div class="col-4 text-center">
        <?php

            //query to get all food from db
            $sql2 = "SELECT * FROM   tbl_food";
            //execute the query
            $res2= mysqli_query($conn, $sql2);

            //count rows to check wheather we have data in database or not
            $count2 = mysqli_num_rows($res2);

            ?>
            <h1><?php echo $count2 ?></h1>
            <br>
            
            Foods
        </div>


        <div class="col-4 text-center">
       
        <?php

            //query to get all orders from db
            $sql3 = "SELECT * FROM   tbl_order";
            //execute the query
            $res3= mysqli_query($conn, $sql3);

            //count rows to check wheather we have data in database or not
            $count3 = mysqli_num_rows($res3);

            ?>
            <h1><?php echo $count3 ?></h1>
            <br>
            
            Total Orders
        </div>

        <div class="col-4 text-center">
        <?php

            //query to get all orders from db
            $sql4 = "SELECT SUM(total)AS Total FROM   tbl_order WHERE status='Delivered'";
            //execute the query
            $res4= mysqli_query($conn, $sql4);

            //count rows to check wheather we have data in database or not
            //$count3 = mysqli_num_rows($res3);
            $row4 = mysqli_fetch_assoc($res4);
            //GET the total revenue
            $total_revenue=$row4['Total'];
    
        ?>
            <h1>Rs.<?php echo $total_revenue; ?></h1>
            <br>
            Revenue Generated
        </div>

        <div class="clearfix"> </div>
    </div>
</div>
<!--Main Content section ends--->

<?php include('partials/footer.php'); ?>