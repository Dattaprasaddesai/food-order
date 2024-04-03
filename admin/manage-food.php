<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br>
        <br>
        <!--button to add admin--->
        <a href="add-food.php" class="btn-primary">Add Food</a>
        <br>

        <br>

        <?php
        if (isset($_SESSION['add'])) //checking wheather the session is set or not
        {
            echo $_SESSION['add']; //displaying session message
            unset($_SESSION['add']); //removing session message

        }

        if (isset($_SESSION['delete'])) //checking wheather the session is set or not.
        {
            echo $_SESSION['delete']; //displaying session message
            unset($_SESSION['delete']); //removing session message

        }
        if (isset($_SESSION['remove'])) //checking wheather the session is set or not.
        {
            echo $_SESSION['remove']; //displaying session message
            unset($_SESSION['remove']); //removing session message

        }
        if (isset($_SESSION['unauthorize'])) //checking wheather the session is set or not.
        {
            echo $_SESSION['unauthorize']; //displaying session message
            unset($_SESSION['unauthorize']); //removing session message

        }
        ?>

        <br>

        <table class="tbl-full">

            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //query to get all categories from db
            $sql = "SELECT * FROM   tbl_food";
            //execute the query
            $res = mysqli_query($conn, $sql);

            //count rows to check wheather we have data in database or not
            $count = mysqli_num_rows($res);


            //check the no of rows
            $sn = 1;

            if ($count > 0) {
                //we have data in db
                //get the data & display
                while ($rows = mysqli_fetch_assoc($res)) {

                    //using while loops to get all the data from database.
                    //& while loop will run as long as we have data in database.

                    //Get individual data
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price = $rows['price'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];

                    //Display the values in our table
            ?>

                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo "Rs $price"; ?></td>


                        <td>

                            <?php
                            //check wheather the  image name is  available or not
                            if ($image_name != "") {
                                //Display the Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                            <?php
                            } else {
                                //Display the message
                                echo "<div class='error'>Image not Added.</div>";
                            }

                            ?>
                        </td>

                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>

                            <a href="<?php echo  SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>$image_name=" class="btn-secondary">Update Food</a>
                            <a href="<?php echo  SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class=" btn-danger">Delete Food</a>
                        </td>
                    </tr>


                <?php

                }
            } else {
                //we do not have data in db
                //we will display message inside table
                ?>
                <tr>
                    <td colspan="7">
                        <div class='error'>No Category Added.</div>
                    </td>
                </tr>
            <?php
            }
            ?>




        </table>


    </div>
</div>

<?php include('partials/footer.php'); ?>