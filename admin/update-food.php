<?php include('partials/menu.php')?>

<?php
    //Check whether id is set or not
    if(isset($_GET['foodID']))
    {
        //get details
        $foodID = $_GET['foodID'];
        //sql query to get the selected food
        $sql2= "SELECT * FROM food_table WHERE foodID=$foodID";
        //execute the query
        $res2 = mysqli_query($conn,$sql2);

        //get the values
        $row2 = mysqli_fetch_assoc($res2);

        //get individual values
        $foodTitle = $row2['foodTitle'];
        $foodDesc = $row2['foodDesc'];
        $foodPrice = $row2['foodPrice'];
        $current_image = $row2['foodImage'];
        $current_category = $row2['foodCategoryID'];
        $foodFeatures = $row2['foodFeatures'];
        $foodActive = $row2['foodActive'];

    }
    else
    {
        header("location:" . SITEURL . 'admin/manage-food.php');
    }

?>



<div class = "main-content">
    <div class = "wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

         <table class="tbl-30">
             <tr>
                 <td>Title:</td>
                 <td>
                     <input type="text" name="foodTitle" value ="<?php echo $foodTitle; ?>">
                 </td>
             </tr>

             <tr>
                 <td>Description :</td>
                 <td>
                     <textarea name="foodDesc" cols="30" rows="5"> <?php echo $foodDesc; ?></textarea>
                 </td>
             </tr>

             <tr>
                 <td>Price :</td>
                 <td>
                     <input type="number" name="foodPrice" value ="<?php echo $foodPrice; ?>">
                 </td>
             </tr>

             <tr>
                 <td>Current Image :</td>
                 <td>
                     <?php
                     if($current_image=="")
                     {
                         //image not available
                         echo "<div class='error'>Image not available</div>";
                     }
                     else
                     {
                         //image available
                         ?>
                         <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                         <?php
                     }

                     ?>
                 </td>
             </tr>

             <tr>
                 <td>Select new image :</td>
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
                         $res = mysqli_query($conn,$sql);
                         //Count rows to check whether we have categories or not
                         $count = mysqli_num_rows($res);
                         //if count is greater than zero, we have categories else we do not have categories
                         if($count>0)
                         {
                             //categories found
                             while($row=mysqli_fetch_assoc($res))
                             {
                                 //get the details of category
                                 $category_title = $row['foodTitle'];
                                 $category_id = $row['foodID'];


                                 ?>
                                 <option <?php if($current_category==$category_id){echo "selected";} ?> value = "<?php echo $category_id; ?>"><?php echo $category_title; ?> </option>
                                <?php


                             }
                         }
                         else
                         {
                             //categories not found

                             echo "<option value='0'>Category not available</option>";

                         }
                         ?>

                 </td>
             </tr>

             <tr>
                 <td>Featured:</td>
                 <td>
                     <input <?php if($foodFeatures=="Yes") {echo "checked";} ?> type="radio" name = "foodFeatures" value="Yes"> Yes
                     <input <?php if($foodFeatures=="No") {echo "checked";} ?> type="radio" name = "foodFeatures" value="No"> No
                 </td>
             </tr>

             <tr>
                 <td>Active :</td>
                 <td>
                     <input <?php if($foodActive=="Yes") {echo "checked";} ?> type="radio" name = "foodActive" value="Yes"> Yes
                     <input <?php if($foodActive=="No") {echo "checked";} ?> type="radio" name = "foodActive" value="No"> No
                 </td>
             </tr>

             <tr>
                 <td>
                     <input type="hidden" name="foodID" value = "<?php echo $foodID; ?>">
                     <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                     <input type="submit" name="submit" value="Update Food" class ="btn-secondary">
                 </td>
             </tr>


         </table>

        </form>

        <?php

        if(isset($_POST['submit']))
        {
            //get all the details from the forms
            $foodID = $_POST['foodID'];
            $foodTitle = $_POST['foodTitle'];
            $foodDesc = $_POST['foodDesc'];
            $foodPrice = $_POST['foodPrice'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $foodFeatures = $_POST['foodFeatures'];
            $foodActive = $_POST['foodActive'];
            //upload the image if selected

            //check whether upload button is clicked or not
            if(isset($_FILES['image']['name']))
            {
                //if button is clicked
                $foodImage = $_FILES['image']['name'];

                if($foodImage!="")
                {
                    //get the extension of selected image
                    $ext = end(explode('.', $foodImage));
                    //create the name for image name
                    $foodImage = "Food-name-" . rand(0000,9999) . "." . $ext;
                    $src_path = $_FILES['image']['tmp_name'];
                    $dst_path = "../images/food/" . $foodImage;

                    //upload the image
                    $upload = move_uploaded_file($src_path,$dst_path);

                    //check whether image uploaded or not
                    if($upload==false)
                    {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                        header("location:" . SITEURL . 'admin/manage-food.php');
                        die();
                    }
                    //remove current image if available
                    if($current_image!="")
                    {
                        //current image is available
                        //remove the image
                        $remove_path= "../images/food/".$current_image;
                        $remove = unlink($remove_path);

                        //check whether the image is removed or bnot
                        if($remove==false)
                        {
                            $_SESSION['wemove-failed'] = "<div class='error'>Failed to Remove image</div>";
                            header("location:" . SITEURL . 'admin/manage-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $foodImage = $current_image; //default image when image is not selected
                }

            }
            else
            {
                $foodImage = $current_image; //default image when button is not clicked
            }

            //remove the image if new image is uploaded and current image exists

            //update the food in the database
            $sql3="UPDATE food_table SET
                    foodTitle = '$foodTitle',
                    foodDesc = '$foodDesc',
                    foodPrice = $foodPrice,
                    foodImage = '$foodImage',
                    foodCategoryID = '$category',
                    foodFeatures = '$foodFeatures',
                    foodActive ='$foodActive'  
                    WHERE foodID=$foodID
                      ";

            //execute the query
            $res3 = mysqli_query($conn,$sql3);
            if($res3==TRUE)
            {
                $_SESSION['update'] =  "<div class='success'>Food Updated Successfully</div>";
                header("location:".SITEURL.'admin/manage-food.php');
            }
            else
            {
                $_SESSION['update'] =  "<div class = 'error'>Failed to update Food</div>";
                header("location:".SITEURL.'admin/manage-food.php');
            }
            //redirect to manage food with session manage
        }

        ?>
    </div>
</div>


