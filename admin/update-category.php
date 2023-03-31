<?php include('partials/menu.php')?>
<div class = "main-content">
    <div class = "wrapper">
        <h1> Update Categories </h1>

        <br><br>

        <?php
        if(isset($_GET['foodID']))
        {
            $foodID = $_GET['foodID'];

            $sql = "SELECT * FROM food_category WHERE foodID=$foodID";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $foodTitle= $row['foodTitle'];
                $current_image = $row['foodImage'];
                $foodFeatures = $row['foodFeatures'];
                $FoodActive = $row['FoodActive'];
            }
            else
            {
                $_SESSION['no-category-found'] = "<div class = 'error'>Category not found</div>";
                header('location:'.SITEURL.'admin/manage-categories.php');
            }
        }
        else
        {
            header("location:".SITEURL.'admin/manage-categories.php');
        }

        ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <table class ="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="foodTitle" value="<?php echo $foodTitle;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php
                                if($current_image!= "")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
                                    <?php

                                }
                                else
                                {
                                    echo "<div class = 'error'>Image not Added </div>";
                                }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($foodFeatures=="Yes"){echo "checked";} ?> type="radio" name="foodFeatures" value="Yes"> Yes
                        <input <?php if($foodFeatures=="No"){echo "checked";} ?> type="radio" name="foodFeatures" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($FoodActive=="Yes"){echo "checked";} ?> type="radio" name="FoodActive" value="Yes"> Yes
                        <input <?php if($FoodActive=="No"){echo "checked";} ?>type="radio" name="FoodActive" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="foodID" value = "<?php echo $foodID; ?>">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
                if(isset($_POST['submit']))
                {
                    $foodID = $_POST['foodID'];
                    $foodTitle = $_POST['foodTitle'];
                    $current_image = $_POST['current_image'];
                    $foodFeatures = $_POST['foodFeatures'];
                    $FoodActive = $_POST['FoodActive'];

                    if(isset($_FILES['image']['name']))
                    {
                        $foodImage = $_FILES['image']['name'];

                        if($foodImage!= "")
                        {
                            $ext = end(explode('.', $foodImage));
                            $foodImage = "Food_Category_" . rand(000, 999) . '.' . $ext;

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/" . $foodImage;


                            $upload = move_uploaded_file($source_path, $destination_path);
                            if ($upload == false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Failed to add image</div>";
                                header("location:" . SITEURL . 'admin/manage-categories.php');
                                die();
                            }
                            if($current_image="")
                            {
                                $remove_path = "../images/category/" .$current_image;
                                $remove = unlink($remove_path);

                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                    header("location:" . SITEURL . 'admin/manage-categories.php');
                                    die();
                                }
                            }

                        }
                        else
                        {
                            $foodImage = $current_image;
                        }
                    }
                    else
                    {
                        $foodImage = $current_image;
                    }


                    $sql2 = "UPDATE food_category SET 
                        foodTitle =  '$foodTitle',
                        foodImage = '$foodImage',
                        foodFeatures = '$foodFeatures',
                        FoodActive = '$FoodActive' 
                         WHERE foodID=$foodID
                         ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2==TRUE)
                    {
                        $_SESSION['update'] =  "<div class='success'>Category Updated Successfully</div>";
                        header("location:".SITEURL.'admin/manage-categories.php');
                    }
                    else
                    {
                        $_SESSION['update'] =  "<div class = 'error'>Failed to Update Category</div>";
                        header("location:".SITEURL.'admin/manage-categories.php');
                    }
                }

        ?>
    </div>
</div>


