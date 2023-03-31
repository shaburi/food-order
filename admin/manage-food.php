<?php include('partials/menu.php')

?>

<div class = "main-content">
    <div class = "wrapper">
        <h1> Manage Food </h1>
        <br /><br />
        <!-- button to add admins -->

        <a href="<?php echo SITEURL; ?>admin/add-food.php " class="btn-primary">Add Food</a>
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if (isset($_SESSION['unauthorized'])) {
            echo $_SESSION['unauthorized'];
            unset($_SESSION['unauthorized']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <table class ="tbl-full">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //create sql query
            $sql = "SELECT * FROM food_table";
            //Executing query
            $res = mysqli_query($conn,$sql);
            //Count rows to check whether we have food or not
            $count = mysqli_num_rows($res);
            //create SN variable
            $sn=1;

            if($count>0)
            {
                //we have food in database
                //get the food from database and display
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $foodID = $row['foodID'];
                    $foodTitle = $row['foodTitle'];
                    $foodPrice = $row['foodPrice'];
                    $foodImage = $row['foodImage'];
                    $foodFeatures = $row['foodFeatures'];
                    $foodActive = $row['foodActive'];
                    ?>
                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $foodTitle; ?></td>
                        <td>RM<?php echo $foodPrice; ?></td>
                        <td>
                            <?php
                                //check whether we have image or not
                                if($foodImage=="")
                                {
                                    echo "<div class = 'error'>Image Not Added</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $foodImage; ?>" width="100px">
                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $foodFeatures; ?></td>
                        <td><?php echo $foodActive; ?></td>
                        <td>
                            <a href="<?php echo SITEURL;?>admin/update-food.php?foodID=<?php echo $foodID; ?>" class ="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?foodID=<?php echo $foodID; ?>&foodImage=<?php echo $foodImage; ?>" class ="btn-delete">Delete Food</a>
                        </td>
                    </tr>
                    <?php

                }
            }
            else
            {
                //food not added in database
                echo "<tr><td colspan='7' class ='error'> Food Not added Yet. </td> </tr>";
            }

            ?>
        </table>


    </div>
