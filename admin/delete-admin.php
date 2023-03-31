<?php

include('../config/constant.php');

$adminID = $_GET['id'];

$sql = "DELETE FROM admin WHERE adminID=$adminID";

$res = mysqli_query($conn,$sql);

if($res==true)
{
    $_SESSION['delete']= "<div class='success'>Admin Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    $_SESSION['delete']= "<div class = 'error'>Fail to delete admin </div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}
?>
