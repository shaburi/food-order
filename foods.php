<?php include ('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //Display all food that are active
            //sql query
            $sql="SELECT * FROM food_table WHERE FoodActive='Yes'";
            //execute
            $res = mysqli_query($conn,$sql);
            //count rows to check whether the category is available or not
            $count=mysqli_num_rows($res);

            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $foodID= $row['foodID'];
                    $foodTitle= $row['foodTitle'];
                    $foodPrice  = $row['foodPrice'];
                    $foodDesc = $row['foodDesc'];
                    $foodImage = $row['foodImage'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                //check whether the image is available or not
                            if($foodImage=="")
                            {
                                echo "<div class = 'error'>Image Not available</div>";
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
                            <h4><?php echo $foodTitle; ?></h4>
                            <p class="food-price">RM<?php echo $foodPrice; ?></p>
                            <p class="food-detail">
                                <?php echo $foodDesc; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $foodID; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                //food not available
                echo "<div class = 'error'>Food Not found.</div>";
            }

            ?>





            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

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