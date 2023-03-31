<?php

include('../config/constant.php');

$orderID= $_GET['orderID'];

$sql = "DELETE FROM ordertbl WHERE orderID=$orderID";

$res = mysqli_query($conn,$sql);

if($res==true)
{
    $_SESSION['delete']= "<div class='success'>Order Deleted Successfully</div>";
    header('location:'.SITEURL.'admin/manage-order.php');
}
else
{
    $_SESSION['delete']= "<div class = 'error'>Fail to delete order </div>";
    header('location:'.SITEURL.'admin/manage-order.php');
}
?>
<?php
