<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br>
        <br>
        <!--button to add admin--->
        <!--<a href="" class="btn-primary">Add Admin</a>-->
        <br>
        <br>
        <br>

        <?php
           if (isset($_SESSION['update'])) //checking wheather the session is set or not
           {
               echo $_SESSION['update']; //displaying session message
               unset($_SESSION['update']); //removing session message
   
           }
        ?>

        <table class="tbl-full">

            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty.</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            //query to get all order from db
            $sql = "SELECT * FROM   tbl_order ORDER BY id DESC ";
            //execute the query
            $res = mysqli_query($conn, $sql);
            //count the rows
    
         //count rows to check wheather we have data in database or not
            $count = mysqli_num_rows($res);
    
    
            $sn = 1; //create a variable and assign a value asd 1
            if ($count > 0) {
                //we have data in db
                //get the data & display
                while ($rows = mysqli_fetch_assoc($res)) {

                    //using while loops to get all the data from database.
                    //& while loop will run as long as we have data in database.

                    //Get individual data
                    $id = $rows['id'];
                    $food = $rows['food'];
                    $price = $rows['price'];
                    $qty = $rows['qty'];
                    $total = $rows['total'];
                    $order_date = $rows['order_date'];

                    $status = $rows['status'];

                    $customer_name = $rows['customer_name'];
                    $customer_contact = $rows['customer_contact'];
                    $customer_email = $rows['customer_email'];
                    $customer_address= $rows['customer_address'];
                    ?>
                    <tr>
                        <td><?php echo  $sn++; ?></td>
                        <td><?php echo  $food; ?></td>
                        <td><?php echo  $price; ?></td>
                        <td><?php echo  $qty; ?></td>
                        <td><?php echo  $total; ?></td>
                        <td><?php echo  $order_date; ?></td>


                        <td><?php
                        // echo  $status; 

                         //ORDERED,on dELIVERY ,dELIVERED,cANCELLED
                         if($status=="Ordered")
                         {
                            echo "<label style='color:blue;'>$status</label>";

                         }
                         elseif($status=="ON Delivery"){
                            echo "<label style='color:orange;'>$status</label>";
                         }
                         elseif($status=="Delivered"){
                            echo "<label style='color:green;'>$status</label>";
                         }
                         elseif($status=="Cancelled"){
                            echo "<label style='color:red;'>$status</label>";
                         }

                         
                         
                         ?>
                        </td>



                        <td><?php echo  $customer_name; ?></td>
                        <td><?php echo  $customer_contact; ?></td>
                        <td><?php echo  $customer_email?></td>
                        <td><?php echo  $customer_address ?></td>
                        <!--<th><?php echo  $sn++ ?>.</th>-->
                        <td >
                       
                       
                        <a href="<?php echo  SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                         </td>


                        
                    </tr>    


                    <?php

                }
            }
            else {
                //we do not have data in db
                //we will display message inside table
                ?>
                <tr>
                    <td colspan="11">
                        <div class='error'>order not available.</div>
                    </td>
                </tr>
                <?php
            }
            ?>
             
             
                </tr>
        </table>


    </div>
</div>

<?php include('partials/footer.php'); ?>

