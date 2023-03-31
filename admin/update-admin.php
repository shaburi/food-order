<?php include('partials/menu.php');?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        $adminID = $_GET['id'];

        $sql = "SELECT * FROM admin WHERE adminID=$adminID";

        $res = mysqli_query($conn,$sql);

        if($res==true)
        {
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $adminName=$row['adminName'];
                $adminPhoneNo=$row['adminPhoneNo'];

            }
            else
            {
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        ?>

        <form action="" method="POST">

            <table class ="tbl-30">
                <tr>
                    <td>Full Name :</td>
                    <td>
                        <input type = "text" name="adminName" value ="<?php echo $adminName?>">
                    </td>
                </tr>

                <tr>
                    <td>Phone No: </td>
                    <td>
                        <input type = "text" name="adminPhoneNo" value ="<?php echo $adminPhoneNo ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name ="adminID" value = "<?php echo $adminID; ?>">
                        <input type="submit" name ="submit" value="Update Admin" class ="btn-secondary">

                    </td>
                </tr>

            </table>


        </form>

    </div>


</div>

<?php
if(isset($_POST['submit']))
{
     $adminID = $_POST['adminID'];
     $adminName=$_POST['adminName'];
     $adminPhoneNo=$_POST['adminPhoneNo'];

     $sql = "UPDATE admin SET
     adminName = '$adminName',
     adminPhoneNo = '$adminPhoneNo'
    WHERE adminID='$adminID'
     ";

     $res = mysqli_query($conn,$sql);

     if($res==true)
     {
         $_SESSION['update']= "<div class='success'>Admin Updated Successfully</div>";
         header('location:'.SITEURL.'admin/manage-admin.php');
     }
     else
     {
         $_SESSION['update']= "<div class='error'>Admin Update Failed</div>";
         header('location:'.SITEURL.'admin/manage-admin.php');
     }
}

?>