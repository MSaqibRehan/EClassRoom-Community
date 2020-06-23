<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
   
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>blog</title>
    <!-- meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
       <link href="css/style.css" rel="stylesheet" type="text/css" />
       <link rel="icon" type="image/jpg" href="images/icon.png">
    <link href="css/fontawesome-all.css" rel="stylesheet" />
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.js" type="text/javascript" ></script>
    <script src="bootstrap/js/popper.min.js" type="text/javascript" ></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>


</head>


<body >
    <div class="row container-fluid">
         
    <div class=" w3l-login-form w-50 mt-5" >
        <h2>Login Here</h2>
        <?php if (isset($_SESSION['message'])) {
            message();
        } ?>
       
        <form action="" method="POST">

            <div class="form-group">
                <label class="text-white">Username:</label>
                <div class="group">
                    <span class="input-group-addon">
                    <i class="fas fa-user"></i>
                </span>
                    <input type="text" class="form-control" name="name" placeholder="Username"  />
                </div>
            </div>
            <div class="form-group">
                <label class="text-white">Password:</label>
                <div class="group">
                    <i class="fas fa-unlock"></i>
                    <input type="password" class="form-control" name="pass" placeholder="Password" />
                </div>
            </div>
            <div class="forgot">
                <a href="forgotpassword.php" class="font-weight-bold">Forgot Password?</a>
                
            </div>
            <button type="submit" name="login">Login</button>
        </form>
       
</div>
</div>
<?php

                    if (isset($_POST['login'])){


                    $username=mysqli_real_escape_string($conn , $_POST['name']);
                    $password = mysqli_real_escape_string($conn ,  $_POST['pass']);
                    $pass = md5($password);
                    $record_query = "SELECT name FROM admin WHERE name='{$username}' and password='{$pass}'";
            $record = mysqli_query($conn , $record_query);
                    $record_count = mysqli_num_rows($record);

if (empty($username) || empty($password)  ) {
            $_SESSION['message'] = null;
            if (empty($username)) {
                $_SESSION['message'] .= "<li>Enter user name</li>" ;
            }

            if (empty($password)){
                $_SESSION['message'] .= "<li>Enter Password</li>";
            }

            header("location:login.php");
    }
    elseif ($record_count == 0 ) {
        $_SESSION['message'] = null;
        $_SESSION['message'] .= "<li class='text-danger'> Invalid username or password</li>";

        header("location:login.php");
                }
                    $query = "SELECT name FROM admin WHERE name='$username' and password='$pass'";
                    $admin = mysqli_query($conn , $query);
                    $count = mysqli_num_rows($admin);
                     if ($count != 0)
                    {
                    $_SESSION['login_user']=$username;
                    $_SESSION['message'] = "Welcome $username";

                     header("location:dashboard.php");
                   
                      }
                    }

?>

</body>

</html>