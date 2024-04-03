<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="current password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

    </div>
</div>

<?php
//clickked wheather the submit button is clicked or not
if (isset($_POST['submit'])) {
    //echo "cicked";

    //1.get the data from form
    $id = $_GET['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);






    //2.check wheather the  user with current Id and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id   AND  password='$current_password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //check wheather the query executed successfully or not 
    if ($res == true) {
        //check wheather the data is  available or not
        $count = mysqli_num_rows($res);
        //check wheather we have admin data or not
        if ($count == 1) {
            //User exists and password can be changed.
            // echo "user found";
            //check wheather new password and confirm password match or not
            if ($new_password == $confirm_password) {
                //echo "password match";
                //update the password
                $sql2 = "UPDATE tbl_admin  SET 
                password='$new_password'
                WHERE id=$id";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);


                //check wheather the query executed successfully or not 
                if ($res2 == TRUE) {

                    //create a session variable to display message
                    $_SESSION['change-pwd'] = "<div class='success'> Password change Successfully.</div>";
                    //redirect page to manage admin
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                } else {
                    //failed to updated admin
                    // echo "Failed to updated admin";
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password. try again later.</div>";
                    //  //redirect page to manage admin
                    header("location:" . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                //user does not exist set message and  redirect
                $_SESSION['pwd-not-match'] = "<div class='error'>password did not match.</div>";

                //redirect to manage admin page
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //user does not exist set message and  redirect
            $_SESSION['user-not-found'] = "<div class='error'> User Not Found.</div>";

            //redirect to manage admin page
            header("location:" . SITEURL . 'admin/manage-admin.php');
        }
    }




    //3.check wheather new password and confirm password match or not


    //4.change password if all above is true.                          
}

?>

<?php include('partials/footer.php'); ?>