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
    <!-- <link rel="stylesheet" href="../css/login.css"> images\back1.jpeg-->
    <!-- <link rel="stylesheet" href="../css/login.css">
 -->

    <!-- #region -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .login {
           
            margin: 0 auto;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;

            width: 30rem;
            
            
        }

        .login h1 {
            margin-bottom:2px;
            color: #333;
            font-size: 50px; /* Adjust the font size as needed */
        }

        .login input[type="text"],
        .login input[type="password"] {
            width: calc(100% - 40px);
            padding: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .login input[type="submit"] {
            width: 100%;
            /* padding: 10px; */
            margin-top: 3px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 40px;
        }

        .login input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .login a {
            color: #007bff;
            text-decoration: none;
        }

        .login a:hover {
            text-decoration: underline;
        }

        .login p {
            margin-top: 5px;
            font-size: 14px;
            color: #666;
        }
        .login h2 {
            font-size: 20px;
        }

       
    </style>



</head>

<body>
    <section class="food-search text-center">
    <div class="container">
    <div class="text-center ">
        <div class="login ">

            <br> 
            <h1 class="text-center">Login</h1>  <br>
            
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
            <form action="" method="POST"  class="form_class">
               <h2> Username</h2> 
                <input type="text" name="username" placeholder="Enter Username"><br>
                <br/> 

                <h2>Password</h2>
                <input type="password" name="password" placeholder="Enter password">
                <br> <br>


                <input type="submit" name="submit" value="Login" class="btn-primary"><br> <br>
                <!--login form start here-->
            </form>

            <p class="text-center"><h2><strong>Created By-</strong></h2><a href="www.pundalik_desai_15.com"><h3> Pundalik Desai & Ayush Amberkar</h3></a></p>
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