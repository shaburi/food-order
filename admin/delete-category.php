<?php

    include('../config/constant.php');
    if(isset($_GET['foodID']) AND isset($_GET['foodImage']))
    {
        $foodID = $_GET['foodID'];
        $foodImage = $_GET['foodImage'];


        if($foodImage!="")
        {
            $path = "../images/category/" .$foodImage;
            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove'] = "<div class = 'error'>Fail to remove image </div>";
                header('location:'.SITEURL.'admin/manage-categories.php');
                die();
            }

        }
        $sql = "DELETE FROM food_category WHERE foodID=$foodID";

        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete']= "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-categories.php');
        }
        else
        {
            $_SESSION['delete']= "<div class = 'error'>Fail to delete category </div>";
            header('location:'.SITEURL.'admin/manage-categories.php');
        }


    }
    else
    {
        header('location:'.SITEURL.'admin/manage-categories.php');
    }
?>
