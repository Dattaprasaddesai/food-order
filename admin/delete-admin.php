<?php
include('partials/menu.php');
//include constant.php  file here
include('../config/constants.php');



//1.get the id of admin to be deleted
$id = $_GET['id'];

//2.create a sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query
$res = mysqli_query($conn, $sql);

//check wheather the query executed successfully or not 
if ($res == true) {
    //Query executed successfully and admin deleted
    //echo " admin deleted";
    //create a session variable to display message
    $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfully.</div>";
    //redirect page to manage admin
    header("location:" . SITEURL . 'admin/manage-admin.php');
} else {
    //failed to delete admin
    // echo "Failed to Delete admin";
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin . try again later.</div>";
    //redirect page to manage admin
    header("location:" . SITEURL . 'admin/manage-admin.php');
}
    


    //3. redirect to manage admin page with message(sucess/error) 
