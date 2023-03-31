<?php include ('partials/menu.php'); ?>

<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Admin</h1>

        <br><br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>


        <form action="" method="POST">

            <table class = "tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="adminName" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Phone No: </td>
                    <td>
                        <input type="text" name="adminPhoneNo" placeholder="Enter Your Phone No" pattern="[0-9]{3}-[0-9]{7}">
                    </td>
                </tr>

                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="adminPassword" placeholder="Your Password" pattern = "(?=.*\d)(?=.*[a-z)(?=.*[A-Z]).{8,}" >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class ="btn-secondary">
                    </td>
                </tr>


            </table>

        </form>

    </div>

</div>


<?php

        if(isset($_POST['submit']))
        {
            $adminName = $_POST['adminName'];
            $adminPhoneNo = $_POST['adminPhoneNo'];
            $adminPassword = md5($_POST['adminPassword']);

            $sql = "INSERT INTO admin SET
            adminName = '$adminName',
            adminPhoneNo = '$adminPhoneNo',
            adminPassword = '$adminPassword'
             ";

            $res = mysqli_query($conn,$sql) or die(mysqli_error());

            if($res==TRUE)
            {
                    $_SESSION['add'] =  "<div class='success'>Admin Added Successfully</div>";
                    header("location:".SITEURL.'admin/manage-admin.php');
            }
            else
            {
                $_SESSION['add'] =  "<div class = 'error'>Failed to Add admin</div>";
                header("location:".SITEURL.'admin/addAdmin.php');
            }

        }


?>

