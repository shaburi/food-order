<?php include ('partials/menu.php'); ?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Food</h1>


        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                <td>Title : </td>
                <td>
                    <input type="text" name="foodTitle" placeholder="Title of the food">
                </td>
                </tr>

                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="foodDesc" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                        <input type="number" name="foodPrice">
                    </td>
                </tr>

                <tr>
                    <td>Select Image :</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">

                            <?php
                            //create php code to display category
                            //Create sql to get category
                            $sql= "SELECT * FROM food_category WHERE FoodActive ='Yes'";
                            //Executing query
                            $res = mysqli_query($conn,$sql);
                            //Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);
                            //if count is greather than zero, we have categories else we do not have categories
                            if($count>0)
                            {
                                //categories found
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of category
                                    $foodID = $row['foodID'];
                                    $foodTitle = $row['foodTitle'];
                                    ?>

                                    <option value="<?php echo $foodID; ?>"><?php echo $foodTitle; ?></option>

                                    <?php

                                }
                            }
                            else
                            {
                                //categories not found
                                ?>
                                <option value="0">No Categories found</option>
                                <?php
                            }

                            //Display
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name = "foodFeatures" value="Yes"> Yes
                        <input type="radio" name = "foodFeatures" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name = "foodActive" value="Yes"> Yes
                        <input type="radio" name = "foodActive" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class ="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

        <?php

                //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //add the food in the database

                //Get the data from form
                $foodTitle = $_POST['foodTitle'];
                $foodDesc = $_POST['foodDesc'];
                $foodPrice = $_POST['foodPrice'];
                $category = $_POST['category'];

                //check whether the radio button for featured and active are checked or not

                if(isset($_POST['foodFeatures']))
                {
                    $foodFeatures = $_POST['foodFeatures'];
                }
                else
                {
                    $foodFeatures = "No"; //setting the default value
                }
                if(isset($_POST['foodActive']))
                {
                    $foodActive = $_POST['foodActive'];
                }
                else
                {
                    $foodActive = "No"; //setting the default value
                }



                //Upload the image if selected
                //Check whether the select mage is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details of the selected image
                    $foodImage = $_FILES['image']['name'];

                    //check whether the image is selected or not and upload image if selected
                    if($foodImage!="")
                    {
                        //image is selected
                        //rename the image
                        //get the extension of selected image
                        $image_info = explode('.',$foodImage);
                        $ext = end($image_info);
                        //create the name for image name
                        $foodImage = "Food-name-".rand(0000,9999).".".$ext;
                        //upload the image
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$foodImage;
                        $upload = move_uploaded_file($src,$dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header("location:" . SITEURL . 'admin/add-food.php');
                            die();
                        }

                    }
                }
                else
                {
                    $foodImage = ""; //setting the default value
                }


                //Insert unto database

                //create sql query
                $sql2 = "INSERT INTO food_table SET
                    foodTitle = '$foodTitle',
                    foodDesc = '$foodDesc',
                    foodPrice = $foodPrice,
                    foodImage = '$foodImage',
                    foodCategoryID = $category,
                    foodFeatures = '$foodFeatures',
                    foodActive ='$foodActive'   
                           ";

                //execute the query

                $res2 = mysqli_query($conn,$sql2);

                    if($res2==TRUE)
                    {
                        $_SESSION['add'] =  "<div class='success'>Food Added Successfully</div>";
                        header("location:".SITEURL.'admin/manage-food.php');
                    }
                    else
                    {
                        $_SESSION['add'] =  "<div class = 'error'>Failed to add Food</div>";
                        header("location:".SITEURL.'admin/manage-food.php');
                    }


            }

        ?>
    </div>

</div>


