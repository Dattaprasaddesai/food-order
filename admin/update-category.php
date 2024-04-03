<?php include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br>
        <br>
        <!--button to update category--->
        <!--<a href="" class="btn-primary">Add Admin</a>-->
        <br>
        <br>
        <br>
        <?php
        if (isset($_GET['id'])) {
            //get the id and all iother details\
            //echo "getting data";
            //1.get the id of admin to be selected
            $id = $_GET['id'];

            //2.create a sql query to get the selected admin details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            //execute the query
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //get the details
                //echo "Category Available";

            } else {
                //redirect to manage category page

                $_SESSION['no-Category-found'] = "<div class='error'> Category Not Found.</div>";
                //redirect page to manage admin
                header("location:" . SITEURL . 'admin/manage-category.php');
            }
        } else {
            //redirect to manage admin page
            header("location:" . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        Image will displayed here
                    </td>
                </tr>

                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>


    </div>
</div>
<?php include('partials/footer.php'); ?>