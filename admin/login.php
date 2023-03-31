<?php include('../config/constant.php'); ?>

<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>
<div class="container">
    <div class="screen">
        <div class="screen__content">
            <form class="login" method="POST">
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input type="text" name="adminName" class="login__input" placeholder="Username" required>
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input type="password" name="adminPassword" class="login__input" placeholder="Password" required>
                </div>
                <button type="submit" name="submit" class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
                <a href="partials/user_manual.pdf"  target="_blank" class="button login__submit">
                    <span class="button__text">User Manual</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </a>
            </form>
            <div class="social-login">
            </div>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>

<?php
if(isset($_SESSION['login']))
{
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}

if(isset($_SESSION['no-login-message']))
{
    echo $_SESSION['no-login-message'];
    unset($_SESSION['no-login-message']);
}

if(isset($_POST['submit']))
{
    $adminName = $_POST['adminName'];
    $adminPassword = md5($_POST['adminPassword']);

    $sql = "SELECT * FROM admin WHERE adminName ='$adminName' AND adminPassword='$adminPassword'";

    $res = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $_SESSION['login']="<div class = 'success'>Login Successful.</div>";
        $_SESSION['adminName'] = $adminName;
        header('location:'.SITEURL.'admin/');
    }
    else
    {
        $_SESSION['login']="<div class = 'error text-center'>Login Failed.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }

}
?>
</body>
</html>
