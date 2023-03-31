<?php include('partials/menu.php');
?>
<!-- Menu Ends -->

<!-- Main Content Starts -->
<div class = "main-content">
    <div class = "wrapper">
        <h1> Manage Admin </h1>
        <br /><br />
        <!-- button to add admins -->

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['user-not-found']))
        {
            echo $_SESSION['user-not-found'];
            unset($_SESSION['user-not-found']);
        }
        if(isset($_SESSION['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if(isset($_SESSION['change-pwd']))
        {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }



        ?>
        <br><br><br>

        <a href="addAdmin.php" class="btn-primary">Add Admin</a>
        <br /><br /><br />
        <table class ="tbl-full">
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Phone No</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM admin";
                $res = mysqli_query($conn , $sql);

                if($res==TRUE)
                {
                    $count = mysqli_num_rows($res);

                    $sn=1;

                    if($count>0)
                    {
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            $adminID = $rows['adminID'];
                            $adminName=$rows['adminName'];
                            $adminPhoneNo=$rows['adminPhoneNo'];

                        ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $adminName?></td>
                                <td><?php echo $adminPhoneNo?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $adminID?>" class ="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $adminID?>" class ="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $adminID?>" class ="btn-delete">Delete Admin</a>
                                </td>


                            </tr>

                        <?php

                        }
                    }
                    else
                    {

                    }
                }

            ?>


        </table>

    </div>
</div>
<!-- Main Content Ends -->


</body>
</html>
