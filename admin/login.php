<?php
include('../config/constants.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login- food order system</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/banner.css">
    <link rel="stylesheet" href="../css/login.css">
    <!--<link rel="stylesheet" href="../css/style.css">-->


</head>

<body>
    <div class="text-center ">
        <div class="login ">

            <br> <br>
            <h1 class="text-center">Login</h1> <br> <br>
            <br>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login']; //displaying session message
                unset($_SESSION['login']); //removing session message

            }
            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message']; //displaying session message
                unset($_SESSION['no-login-message']); //removing session message

            }



            ?>
            <br>



            <!--login form start here-->
            <form action="" method="POST">
                Username:<br>
                <input type="text" name="username" placeholder="Enter Username"><br> <br>

                Password:<br>
                <input type="password" name="password" placeholder="Enter password"><br> <br>
                <br> <br>
                <input type="submit" name="submit" value="login" class="btn-primary"><br> <br>
                <!--login form start here-->
            </form>

            <p class="text-center">Created By-<a href="www.pundalik_desai_15.com">Pundalik Desai _Sahil kadam _Mrunali haldive </a></p>
        </div>
    </div>
</body>

</html>

<?php
//clickked wheather the submit button is clicked or not
if (isset($_POST['submit'])) {
    //echo "cicked";

    //1.get the data from form

    $username = $_POST['username'];
    $password = md5($_POST['password']);


    //2.check wheather the  user with current username and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username'  AND  password='$password'";

    //execute the query
    $res = mysqli_query($conn, $sql);

    //count rows to check wheather the user exists or not.
    $count = mysqli_num_rows($res);

    //if (!$res || mysqli_num_rows($res) == 0) {
    // $num = mysqli_num_rows($res);
    // }

    if ($count == 1) {
        //user available and login success.
        //$_SESSION['user'] = $username;
        $_SESSION['login'] = "<div class='success'> Login Successfull.</div>";
        //$_SESSION['user'] = $username;
        //To checked wheather the user is  logged in or not.& logout will unset it.
        //redirect to home page dashboard.
        // $_SESSION['user'] = $username;
        header("location:" . SITEURL . 'admin/index.php');
    } else {
        //user  not available and login fail.
        $_SESSION['login'] = "<div class='error text-center'> username or password did not match.</div>";
        //redirect to home page dashboard.
        header("location:" . SITEURL . 'admin/login.php');
    }
}



?>