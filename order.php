<?php include ('partials-front/menu.php');?>

        <?php
            //check whether food id is set or not
            if(isset($_GET['food_id']))
            {
                //get the food id and details
                $food_id = $_GET['food_id'];
                $sql = "SELECT * FROM food_table where foodID=$food_id";
                //execute
                $res = mysqli_query($conn,$sql);
                //get the value from database
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //food available
                    $row=mysqli_fetch_assoc($res);
                    $foodTitle= $row['foodTitle'];
                    $foodPrice  = $row['foodPrice'];
                    $foodImage = $row['foodImage'];
                }
                else
                {
                    //food not available
                    header('location:'.SITEURL);
                }
            }
            else
            {
                //redirect to home page
                header('location:'.SITEURL);
            }
        ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                                <div class="food-menu-img">
                                    <?php
                                    // check whether image is available or not
                                    if($foodImage=="")
                                    {
                                        echo "<div class='error'>Image Not available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $foodImage; ?>" alt="Chicken hawaiian pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h3><?php echo $foodTitle; ?></h3>
                                    <input type="hidden" name="orderFood" value="<?php echo $foodTitle; ?>">

                                    <input type="hidden" name="orderPrice" value="<?php echo $foodPrice; ?>">
                                    <span id="totalPrice">RM<?php echo $foodPrice ?></span>

                                    <div class="order-label">Quantity</div>
                                    <input type="number" name="orderQty" id="orderQty" class="input-responsive" value="1" required>

                                </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="custName" placeholder="E.g. Haidhir Syaqimi" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="custContact" placeholder="E.g. 012-7257122" class="input-responsive" pattern="[0-9]{3}-[0-9]{7}" required >

                    <div class="order-label">Email</div>
                    <input type="email" name="custEmail" placeholder="E.g. haidhir98@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="custAddress" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>




            <?php

                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get details
                    $orderFood = $_POST['orderFood'];
                    $orderPrice= $_POST['orderPrice'];
                    $orderQty = $_POST['orderQty'];
                    $orderTotal = $orderPrice * $orderQty;
                    $orderDate = date("Y-m-d h:i:sa");
                    $orderStatus = "Ordered";
                    $custName = $_POST['custName'];
                    $custContact = $_POST['custContact'];
                    $custEmail = $_POST['custEmail'];
                    $custAddress = $_POST['custAddress'];

                    //save the order in database

                    $sql2="INSERT INTO ordertbl SET 
                        orderFood = '$orderFood',
                        orderPrice = $orderPrice,
                        orderQty = $orderQty,
                        orderTotal = $orderTotal,
                        orderDate = '$orderDate',
                        orderStatus = '$orderStatus',
                        custName = '$custName',
                        custContact = '$custContact',
                        custEmail = '$custEmail',
                        custAddress = '$custAddress'
                         ";

                    //execute
                    $res2 = mysqli_query($conn,$sql2);

                    if($res2==true)
                    {
                        $_SESSION['order'] =  "<div class='success text-center'>Food Ordered Successfully</div>";
                        header("location:".SITEURL);
                    }
                    else
                    {
                        $_SESSION['order'] =  "<div class='error text-center'>Food Ordered Failed</div>";
                        header("location:".SITEURL);
                    }
                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="https://www.facebook.com/JYPETWICE/"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="https://www.instagram.com/nct127/"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="https://twitter.com/NCTsmtown_127"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
</section>
    <!-- social Section Ends Here -->



</body>
</html>