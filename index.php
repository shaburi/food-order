<?php include ('partials-front/menu.php');?>



    <!-- fOOD search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD search Section Ends Here -->

        <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        ?>

    <!-- categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //create sql query
            $sql = "SELECT * FROM food_category WHERE FoodActive='Yes' AND foodFeatures='Yes' LIMIT 3";
            //execute
            $res = mysqli_query($conn,$sql);
            //count rows to check whether the category is available or not
            $count=mysqli_num_rows($res);
            //check whether category available or not
            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get values
                    $foodID= $row['foodID'];
                    $foodTitle= $row['foodTitle'];
                    $foodImage = $row['foodImage'];
                    ?>
                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $foodID; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if($foodImage=="")
                                {
                                    echo "<div class = 'error'>Image Not available</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $foodImage; ?>" alt="Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>

                            <h3 class="float-text text-white"><?php echo $foodTitle; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                //not available
                echo "<div class = 'error'>Category Not added</div>";
            }
            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- food menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql2 = "SELECT * FROM food_table WHERE FoodActive='Yes' AND foodFeatures='Yes' LIMIT 6";
            //execute
            $res2 = mysqli_query($conn,$sql2);
            //count rows to check whether the category is available or not
            $count2=mysqli_num_rows($res2);

            if($count2>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get values
                    $foodID= $row['foodID'];
                    $foodTitle= $row['foodTitle'];
                    $foodPrice  = $row['foodPrice'];
                    $foodDesc = $row['foodDesc'];
                    $foodImage = $row['foodImage'];
                    ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check whether image is available or not
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
                echo "<div class = 'error'>Food Not available</div>";
            }

            ?>




            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
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