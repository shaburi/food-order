<?php include ('partials-front/menu.php');?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //Display all categories that are active
            //sql query
            $sql="SELECT * FROM food_category WHERE FoodActive='Yes'";
            //execute
            $res = mysqli_query($conn,$sql);
            //count rows to check whether the category is available or not
            $count=mysqli_num_rows($res);
            if($count>0)
            {
                //categories available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get values
                    $foodID = $row['foodID'];
                    $foodTitle = $row['foodTitle'];
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
                //categories not available
                echo "<div class = 'error'>Category Not found.</div>";
            }

            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


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