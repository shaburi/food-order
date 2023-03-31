<?php include('partials/menu.php')

?>


<div class = "main-content">
    <div class = "wrapper">
    <h1> Manage Categories </h1>
        <br /><br />

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }


        ?>

        <br>
        <!-- button to add admins -->

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br /><br /><br />
        <table class ="tbl-full">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM food_category";

            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            $sn=1;

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $foodID= $row['foodID'];
                    $foodTitle= $row['foodTitle'];
                    $foodImage = $row['foodImage'];
                    $foodFeatures = $row['foodFeatures'];
                    $FoodActive = $row['FoodActive'];
                    ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $foodTitle; ?></td>

                        <td>
                            <?php
                                if($foodImage!="")
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $foodImage;?>" width="100px">

                                <?php
                            }
                                else
                            {
                                echo "<div class = 'error'>Image Not added</div>";
                            }
                            ?>
                        </td>

                        <td><?php echo $foodFeatures; ?></td>
                        <td><?php echo $FoodActive; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?foodID=<?php echo $foodID; ?>" class ="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?foodID=<?php echo $foodID; ?>&foodImage=<?php echo $foodImage; ?>" class ="btn-delete">Delete Category</a>
                        </td>
                    </tr>

                    <?php

                }
            }
            else
            {
                ?>

                <tr>
                    <td colspan="6"><div class="error">No Category Added.</div></td>
                </tr>

                <?php


            }

                ?>


            </tr>
        </table>


</div>