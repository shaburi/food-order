<?php include('partials/menu.php')

?>

<div class = "main-content">
    <div class = "wrapper">
        <h1> Manage Order </h1>

        <br /><br /><br />

        <?php
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        ?>
        <br><br>
        <table class ="tbl-full">
            <tr>
                <th>ID</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer No</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
                //get details
                $sql="SELECT * FROM ordertbl ORDER BY orderID DESC"; //display latest order first
                //execute
                $res = mysqli_query($conn,$sql);
                //count the rows
                $count = mysqli_num_rows($res);

                $sn=1; //id number set as 1

                if($count>0)
                {
                    //order available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get all the orders details
                        $orderID = $row['orderID'];
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

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $orderFood; ?></td>
                            <td><?php echo $orderPrice; ?></td>
                            <td><?php echo $orderQty; ?></td>
                            <td><?php echo $orderTotal; ?></td>
                            <td><?php echo $orderDate; ?></td>

                            <td>
                                <?php
                                    if($orderStatus=="Ordered")
                                        {
                                            echo "<label>$orderStatus</label>";
                                        }
                                        elseif ($orderStatus=="On Delivery")
                                        {
                                            echo "<label style='color: orange;'>$orderStatus</label>";
                                        }
                                        elseif ($orderStatus=="Delivered")
                                        {
                                            echo "<label style='color: green;'>$orderStatus</label>";
                                        }
                                        elseif ($orderStatus=="Cancelled")
                                        {
                                            echo "<label style='color: red;'>$orderStatus</label>";
                                        }
                                ?>
                            </td>

                            <td><?php echo $custName; ?></td>
                            <td><?php echo $custContact; ?></td>
                            <td><?php echo $custEmail; ?></td>
                            <td><?php echo $custAddress; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?orderID=<?php echo $orderID; ?>" class ="btn-secondary">Update Order</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-order.php?orderID=<?php echo $orderID; ?>" class ="btn-delete">Delete Order</a>
                            </td>

                        </tr>
                        <?php
                    }
                }
                else
                {
                    //order not available
                    echo "<tr><td colspan='12' class = 'error'>Order Not available.</td></tr>";
                }

            ?>




        </table>

    </div>
</div>
