<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br>
        <br>

        <?php
             $id = $_GET['id'];

             $sql = "SELECT * FROM tbl_order WHERE id=$id";

             $res = mysqli_query($conn, $sql);

             $count=mysqli_num_rows($res);

             if($count==1)
                {
                    //we have data
                    //get the data from  database
                $rows = mysqli_fetch_assoc($res);

                    //$rows = mysqli_fetch_assoc($res);

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

                    }
                else{
                    //redirect food not available 
                    //redirect to home page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }



        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo  $food;?></b></td>
                   
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b>Rs.<?php echo  $price;?></b></td>
                </tr>

                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo  $qty;?>">
                    </td>   
                </tr>

                <tr>
                     <td> Status</td>
                    <td>
                        <select name ="status">
                        <option <?php if ($status =="Ordered") {echo "selected";} ?> value="Ordered">Ordered</option>
                        <option <?php  if ($status =="ON Delivery") {echo "selected";} ?> value="ON Delivery">ON Delivery</option>
                        <option <?php  if ($status =="Delivered") {echo "selected";} ?> value="Delivered">Delivered</option>
                        <option <?php  if ($status =="Cancelled") {echo "selected";} ?> value="Cancelled">Cancelled</option>
                    </td>

                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
                    </td>   
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>   
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email;?>">
                    </td>   
                </tr>
                <tr>
                    <td>Customer Address</td>
                    <td>
                        <input type="customer_address" cols="30" rows="5" value="<?php echo $customer_address;?>">
                    </td>   
                </tr>

                <tr>
                    <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="price" value="<?php echo $price;?>">

                    <input type="submit" name="submit" value="update order" class="btn-secondary">
                    </td>

                </tr>
            </table>
        </form>

        <?php

if (isset($_POST['submit'])) {
   // isset($_POST['submit']){
    //echo "button clicked";
    //get all the values form form to update
    $id = $_GET['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total=$price *$qty;   //total =price*qty
    //$order_date =date("Y-m-d h:i:sa");  //order date

    $status=$_POST['status']; //ordered ,ondelivery,Delivered ,Cancalled

    $customer_name= $_POST['customer_name'];
    $customer_contact = $_POST['customer_contact'];
    $customer_email= $_POST['customer_email'];
    $customer_address = $_POST['customer_address'];


    //sql query to update admin
    $sql2 = "UPDATE tbl_order SET
            qty='$qty',
             total='$total',
             order_date='$order_date',
             status='$status',
             customer_name='$customer_name',
             customer_contact='$customer_contact',
             customer_email= '$customer_email',
             customer_address= '$customer_address'
    WHERE id='$id'
    ";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);


    //check wheather the query executed successfully or not 
    if ($res2 == TRUE) {
       
        $_SESSION['update'] = "<div class='success'> order updated Successfully.</div>";
        //redirect page to manage order
        header("location:" . SITEURL . 'admin/manage-order.php');
    } else {
       
        $_SESSION['update'] = "<div class='error'>Failed to update order . try again later.</div>";
        //  //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-order.php');
    }
}

?>

                
        

    </div>
</div>
<?php include('partials/footer.php'); ?>