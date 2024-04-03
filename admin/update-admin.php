<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>

        <?php
        //1.get the id of admin to be selected
        $id = $_GET['id'];

        //2.create a sql query to get the selected admin details
        $sql = "SELECT * FROM tbl_admin WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check wheather the query executed successfully or not 
        if ($res == true) {
            //check wheather the data is  available or not
            $count = mysqli_num_rows($res);
            //check wheather we have admin data or not
            if ($count == 1) {
                //get the details
                //echo "Admin Available";
                $rows = mysqli_fetch_assoc($res);

                $full_name = $rows['full_name'];
                $username = $rows['username'];
            } else {
                //redirect to manage admin page
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        }


        ?>


        <form action="" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {

    //echo "button clicked";
    //get all the values form form to update
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //sql query to update admin
    $sql = "UPDATE tbl_admin SET
    full_name = '$full_name',
    username= '$username'
    WHERE id='$id'
    ";

    //execute the query
    $res = mysqli_query($conn, $sql);


    //check wheather the query executed successfully or not 
    if ($res == TRUE) {
        //Query executed successfully and admin updated
        //echo " admin updated";
        //create a session variable to display message
        $_SESSION['update'] = "<div class='success'> Admin updated Successfully.</div>";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //failed to updated admin
        // echo "Failed to updated admin";
        $_SESSION['update'] = "<div class='error'>Failed to update admin . try again later.</div>";
        //  //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    }
}
?>

<?php include('partials/footer.php'); ?>