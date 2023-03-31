<?php include('partials/menu.php');
?>
    <!-- Main Content Starts -->
    <div class = "main-content">
        <div class = "wrapper">
            <h1> Dashboard </h1>
            <br><br>
            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            ?>
            <br><br>
            <div class = "box-4 text-center">
                <?php
                    //sql query
                    $sql = "SELECT * FROM food_category";
                    //execute query
                    $res = mysqli_query($conn,$sql);
                    //count rows
                    $count = mysqli_num_rows($res);
                ?>
            <h1><?php echo $count; ?></h1>
            Categories
            </div>

            <div class = "box-4 text-center">
                <?php
                //sql query
                $sql2 = "SELECT * FROM food_table";
                //execute query
                $res2 = mysqli_query($conn,$sql2);
                //count rows
                $count2 = mysqli_num_rows($res2);
                ?>
                <h1><?php echo $count2; ?></h1>
                Food
            </div>

            <div class = "box-4 text-center">
                <?php
                //sql query
                $sql3 = "SELECT * FROM ordertbl";
                //execute query
                $res3 = mysqli_query($conn,$sql3);
                //count rows
                $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                Total Orders
            </div>

            <div class = "box-4 text-center">

                <?php
                //create sql query to get total revenue generated
                $sql4 = "SELECT SUM(orderTotal) AS Total FROM ordertbl WHERE orderStatus='Delivered'";
                //execute query
                $res4 = mysqli_query($conn,$sql4);
                //get the value
                $row4 = mysqli_fetch_assoc($res4);
                //get the total revenue
                $total_revenue = $row4['Total'];
                ?>

                <h1>RM<?php echo $total_revenue; ?></h1>
              Revenue Generated
            </div>

            <div class = "clearfix"> </div>

        </div>
    </div>
    <!-- Main Content Ends -->
</body>
</html>