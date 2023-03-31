<?php include ('partials/menu.php'); ?>
<div class = "main-content">
    <div class = "wrapper">
        <h1>Update Admin Password</h1>

        <br><br>
        <?php
        if(isset($_SESSION['id']))
        {
            $adminID = $_GET['id'];
        }


        ?>


        <form action="" method="POST">

            <table class ="tbl-30">
                <tr>
                    <td>Current Password :</td>
                    <td>
                        <input type = "password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type = "password" name="new_password" placeholder="Old Password" pattern = "(?=.*\d)(?=.*[a-z)(?=.*[A-Z]).{8,}" >
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type = "password" name="confirm_password" placeholder="Confirm Password" >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $adminID; ?>">
                        <input type="submit" name="submit" value="Change Password" class ="btn-secondary">
                    </td>
                </tr>

            </table>


        </form>

    </div>


</div>

<?php
        if(isset($_POST['submit']))
        {
            $adminID = $_GET['id'];
            $current_password = md5($_POST['current_password']);
            $new_password = md5($_POST['new_password']);
            $confirm_password = md5($_POST['confirm_password']);

            $sql = "SELECT * FROM admin WHERE adminID=$adminID AND adminPassword='$current_password'";

            $res = mysqli_query($conn,$sql);

            if($res==true)
            {
                $count = mysqli_num_rows($res);
                if($count==1)
                {
                    if($new_password==$confirm_password)
                    {
                        $sql2 = "UPDATE admin SET
                        adminPassword='$new_password'
                        WHERE adminID=$adminID
                        ";

                        $res2=mysqli_query($conn,$sql2);

                        if($res2==true)
                        {
                            $_SESSION['change-pwd'] = "<div class = 'success'> Password Changed Successfully. </div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                        else
                        {
                            $_SESSION['change-pwd'] = "<div class = 'error'> Password did not changed. </div>";
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        $_SESSION['pwd-not-match'] = "<div class = 'error'> Password did not match. </div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['user-not-found'] = "<div class = 'error'> User not Found. </div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        }

?>
