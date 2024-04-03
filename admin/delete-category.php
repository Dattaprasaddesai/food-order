<?php
//include constants file
include('../config/constants.php');

//echo delete page
//check wheather the  id and image_name  value is set or not
if (isset($_GET['id']) and isset($_GET['image_name'])) {
    //get the value and delete
    //echo " Get value and delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove  the physical image file is available
    if ($image_name != "") {
        //Image is Available.so remove it
        $path = "../images/category/" . $image_name;
        //Remove  the physical image file  is available
        $remove = unlink($path);

        // if failed to remove image  then add  an error message  and stop the process
        if ($remove == false) {
            //set the session message
            $_SESSION['remove'] = "<div class='error'> Failed to Remove Category Image.</div>";
            //redirect page to manage admin
            header("location:" . SITEURL . 'admin/manage-category.php');
        }
    }

    //Delete data from db
    $sql = "DELETE  FROM tbl_category WHERE id=$id ";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wheather the query executed successfully or not 
    if ($res == true) {
        //Query executed successfully and category deleted
        //echo " category deleted";
        //create a session variable to display message
        $_SESSION['delete'] = "<div class='success'> Category Deleted Successfully.</div>";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-category.php');
    } else {
        //failed to delete category
        // echo "Failed to Delete category";
        $_SESSION['delete'] = "<div class='error'>Failed to delete Category . try again later.</div>";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-category.php');
    }


    //rdirect to manage category  page with message
} else {
    // redirect to manage category page
    header("location:" . SITEURL . 'admin/manage-category.php');
}


?>
<!--u-->