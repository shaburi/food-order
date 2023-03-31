<?php include ('partials/menu.php'); ?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <!-- add category form-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="foodTitle" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Feature:</td>
                    <td>
                        <input type="radio" name="foodFeatures" value="Yes"> Yes
                        <input type="radio" name="foodFeatures" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="FoodActive" value="Yes"> Yes
                        <input type="radio" name="FoodActive" value="Yes"> No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">

                    </td>
                </tr>

            </table>

        </form>

        <?php
            if(isset($_POST['submit']))
            {
                   $foodTitle = $_POST['foodTitle'];

                if(isset($_POST['foodFeatures']))
                {
                    $foodFeatures = $_POST['foodFeatures'];
                }
                else
                {
                    $foodFeatures = "No";
                }

                if(isset($_POST['FoodActive']))
                {
                    $FoodActive = $_POST['FoodActive'];

                }
                else
                {
                    $FoodActive = "No";
                }

                if(isset($_FILES['image']['name']))
                {

                    $foodImage= $_FILES['image']['name'];
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
                            header("location:" . SITEURL . 'admin/add-category.php');
                            die();
                        }

                    }

                }
                else
                {
                    $image_name="";
                }



                $sql = "INSERT INTO food_category SET
                foodTitle =  '$foodTitle',
                foodImage = '$foodImage' , 
                foodFeatures = '$foodFeatures',
                FoodActive = '$FoodActive'       
                              ";
                $res = mysqli_query($conn,$sql);

                    if($res==TRUE)
                    {
                        $_SESSION['add'] =  "<div class='success'>Category Added Successfully</div>";
                        header("location:".SITEURL.'admin/manage-categories.php');
                    }
                    else
                    {
                    $_SESSION['add'] =  "<div class = 'error'>Failed to Add Category</div>";
                    header("location:".SITEURL.'admin/manage-categories.php');
                    }




            }


        ?>
        <!-- add category form-->
    </div>
</div>
