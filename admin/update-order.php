<?php include ('partials/menu.php'); ?>

    <div class = "main-content">
        <div class="wrapper">
            <h1>Update Order</h1>
            <br><br>


            <?php
                //check whether id is set or not
            if(isset($_GET['orderID']))
            {
                //get the food id and details
                $orderID  = $_GET['orderID'];
                //sql query
                $sql = "SELECT * FROM ordertbl WHERE orderID=$orderID";
                //execute
                $res = mysqli_query($conn,$sql);
                //count rows
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $orderFood = $row['orderFood'];
                    $orderPrice= $row['orderPrice'];
                    $orderQty = $row['orderQty'];
                    $orderTotal = $row['orderTotal'];
                    $orderDate = $row['orderDate'];
                    $orderStatus = $row['orderStatus'];
                    $custName = $row['custName'];
                    $custContact = $row['custContact'];
                    $custEmail = $row['custEmail'];
                    $custAddress = $row['custAddress'];
                }
                else
                {
                    //detail not available
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //redirect to home page
                header('location:'.SITEURL.'admin/manage-order.php');
            }

            ?>

            <form action="" method="POST">

                <table class="tbl-30">
                    <tr>
                        <td>Food Name</td>
                        <td><b><?php echo $orderFood; ?></b></td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            <b>RM<?php echo $orderPrice; ?></b>
                        </td>
                    </tr>

                    <tr>
                        <td>Quantity</td>
                        <td>
                            <input type="number" name="orderQty" value="<?php echo $orderQty; ?>">
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="orderStatus">
                                <option <?php if ($orderStatus=="Ordered"){echo "selected";} ?>value="Ordered">Ordered</option>
                                <option <?php if ($orderStatus=="On Delivery"){echo "selected";} ?>value="On Delivery">On delivery</option>
                                <option <?php if ($orderStatus=="Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                                <option <?php if ($orderStatus=="Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>


                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Name:</td>
                        <td>
                            <input type="text" name="custName" value="<?php echo $custName; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Contact:</td>
                        <td>
                            <input type="text" name="custContact" value="<?php echo $custContact; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Email:</td>
                        <td>
                            <input type="text" name="custEmail" value="<?php echo $custEmail; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Customer Address:</td>
                        <td>
                            <textarea name="custAddress" cols="30" rows="5"><?php echo $custAddress; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
                            <input type="hidden" name="orderPrice" value="<?php echo $orderPrice; ?>">
                            <input type="submit" name="submit" value="Update-order" class="btn-secondary">
                        </td>
                    </tr>

                </table>

            </form>

            <?php
            if(isset($_POST['submit']))
            {
                //get all the values
                $orderID = $_POST['orderID'];
                $orderPrice = $_POST['orderPrice'];
                $orderQty = $_POST['orderQty'];
                $orderTotal = $orderPrice * $orderQty;
                $orderStatus = $_POST['orderStatus'];
                $custName = $_POST['custName'];
                $custContact = $_POST['custContact'];
                $custEmail = $_POST['custEmail'];
                $custAddress = $_POST['custAddress'];

                //update the values
                $sql2 = "UPDATE ordertbl SET
                        orderQty = $orderQty,
                        orderTotal = $orderTotal,
                        orderStatus = '$orderStatus',
                        custName = '$custName',
                        custContact = '$custContact',
                        custEmail = '$custEmail',
                        custAddress = '$custAddress'
                    WHERE orderID=$orderID
                    ";

                $res2 = mysqli_query($conn,$sql2);

                //check whether its updated or not

                if($res2==true)
                {
                    $_SESSION['update'] =  "<div class='success'>Order Updated Successfully</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update'] =  "<div class='error'>Order Update Failed</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

            }

            ?>

        </div>

    </div>
