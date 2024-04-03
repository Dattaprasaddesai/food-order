<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>

        <?php
        if (isset($_SESSION['add'])) //checking wheather the session is set or not.
        {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message

        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">

                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
//process the value from form and save it in the database
//checked wheather the submit button is clicked or not 

if (isset($_POST['submit'])) {
    //button clicked
    //echo "Button Clicked";

    //1. get  the Data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    //password Encryption using md5

    //2. sql query to save data into database
    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'

        ";

    //3. execute query and save data in database.
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn, $sql));

    //4.check wheather the(query is executed  ) data is insertd or not and display apporopriate message
    if ($res == TRUE) {
        //DATA INSERTED
        echo "data inserted";
        //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
        $_SESSION['add'] = "<div class='success'> Admin Added Successfully.</div>";
        //redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //FAIL TO DATA INSERTED
        //echo "FAIL TO INSERT DATA";
        //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
        $_SESSION['add'] = "<div class='error'>Failed to  Add Admin.</div> ";
        //redirect page to add admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}
?>



<!-- hii-->