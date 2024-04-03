<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>


        <?php
        if (isset($_SESSION['add'])) //checking wheather the session is set or not
        {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message

        }

        if (isset($_SESSION['upload'])) //checking wheather the session is set or not
        {
            echo $_SESSION['upload']; //displaying session message
            unset($_SESSION['upload']); //removing session message

        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php

                            //query to get all category
                            $sql = "SELECT * FROM   tbl_category WHERE active='Yes'";

                            //execute the query
                            $res = mysqli_query($conn, $sql);

                            //check wheather the categories is  available or not
                            $count = mysqli_num_rows($res);

                            //if count is greater than zero, we have categories else we do not have categories

                            if ($count > 0) {
                                //we have categories in database 
                                while ($rows = mysqli_fetch_assoc($res)) {

                                    //Get individual datails of category
                                    $id = $rows['id'];
                                    $title = $rows['title'];


                                    //Display the values in our table
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo  $title; ?> </option>
                                <?php
                                }
                            } else {
                                //we do not have categories
                                ?>
                                <option value="0">NO Category found</option>
                            <?php
                            }


                            //display on dropdown 

                            ?>


                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            //button clicked
            //echo "Button Clicked";
            //Get individual data
            //1. get  the Data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            // $image_name = $_POST['image_name']


            //for radio input ,we need to check wheather the button is clicked or not
            if (isset($_POST['featured'])) {
                //get the value from form
                $featured = $_POST['featured'];
            } else {
                //set the default value
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                //get the value from form
                $active = $_POST['active'];
            } else {
                //set the default value
                $active = "No";
            }

            //2.upload the image if selected 
            //check wheather the select image is clicked or not and  upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {
                //upload the image
                //to upload image we needimage name, source path ,destination path
                $image_name = $_FILES['image']['name'];


                //check wheather the image is selected or not  and upload the image only if selected
                if ($image_name != "") {
                    //Auto rename image
                    //get the extension of image(jpg,png,gif,etc) e.g. "Specialfood1.jpg"
                    $ext = end(explode('.', $image_name));

                    //rename the image
                    $image_name = "Food_name_" . rand(000, 999) . '.' . $ext; //e.g .  Food_Name_834.jpg

                    //source path
                    $source_path1 = $_FILES['image']['tmp_name'];
                    //destination path
                    $destination_path1 = "../images/food/" . $image_name;

                    //finally upload image
                    $upload = move_uploaded_file($source_path1, $destination_path1);

                    //check wheather the Image is uploaded or not
                    //And  if image not uploaded then we will stop the process and redirect with error message.
                    if ($upload == false) {
                        //SET message
                        $_SESSION['upload'] = "<div class='error'>Failed to  upload image.</div> ";

                        header("location:" . SITEURL . 'admin/add-food.php');
                        //stop the process
                        die();
                    }
                }
            } else {
                //Dont upload image and set the image_name As Blank.
                $image_name = "";
            }

            ///3.insert into databse
            //sql query to save data /save food into database
            $sql2 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price='$price',
                image_name='$image_name',
                category_id=$category,
                featured='$featured',
                active='$active'
                ";

            //3. execute query and save data in database.
            $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn, $sql2));


            //redirect with message to manage food page
            if ($res2 == TRUE) {
                //DATA INSERTED
                //echo "data inserted";
                //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
                $_SESSION['add'] = "<div class='success'> food Added Successfully.</div>";
                //redirect page to manage admin
                header("location:" . SITEURL . 'admin/manage-food.php');
            } else {
                //FAIL TO DATA INSERTED
                //echo "FAIL TO INSERT DATA";
                //CREATE A SESSION VARIABLE TO DISPLAY MESSAGE
                $_SESSION['add'] = "<div class='error'>Failed to  Add food.</div> ";
                //redirect page to add admin
                header("location:" . SITEURL . 'admin/add-food.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>