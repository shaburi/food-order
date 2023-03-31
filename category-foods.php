<?php include ('partials-front/menu.php');?>


<?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        //get category title based on id
        $sql="SELECT foodTitle FROM food_category WHERE foodID=$category_id";
        //execute the query
        $res = mysqli_query($conn,$sql);
        //get the value from database
        $row=mysqli_fetch_assoc($res);
        //get the title
        $category_title = $row['foodTitle'];


    }
    else
    {
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD search Section Ends Here -->



    <!-- fOOD menu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //create sql query
            $sql2="SELECT * FROM food_table WHERE foodCategoryID=$category_id" ;
            //execute the query
            $res2 = mysqli_query($conn,$sql2);
            //count the row
            $count2=mysqli_num_rows($res2);

            //check whether food is available
            if($count2>0)
            {
                //food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $foodID = $row2['foodID'];
                    $foodTitle= $row2['foodTitle'];
                    $foodPrice  = $row2['foodPrice'];
                    $foodDesc = $row2['foodDesc'];
                    $foodImage = $row2['foodImage'];
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
                //food is not available
                echo "<div class = 'error'>Food is not available.</div>";
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