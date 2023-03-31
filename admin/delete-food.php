<?php

include('../config/constant.php');
    if(isset($_GET['foodID']) && isset($_GET['foodImage']))
    {
        //process to delete

        //get id and image name
        $foodID = $_GET['foodID'];
        $foodImage = $_GET['foodImage'];
        // remove image if available
        if($foodImage!="")
        {
            //get image path
            $path = "../images/food/" .$foodImage;
            //remove image file from folder
            $remove = unlink($path);

            //check whether the image is removed or not
            if($remove==false)
            {
                //if failed
                $_SESSION['upload'] = "<div class = 'error'>Fail to remove image </div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }

        }
        // delete food from database
         $sql = "DELETE FROM food_table WHERE foodID=$foodID";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //check the query executed or not
        //redirect manage with session message
        if($res==true)
        {
            $_SESSION['delete']= "<div class='success'>Food Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            $_SESSION['delete']= "<div class = 'error'>Fail to delete food </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }


    }
    else
    {
        //redirect to manage food page
        $_SESSION['unauthorized']= "<div class = 'error'>Unauthorized access </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>
