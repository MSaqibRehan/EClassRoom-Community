<?php
  include 'includes/config.php';
  include 'includes/sessions.php';

?>
<?php
    if (isset($_GET['account'])) {
        $account_id = $_GET['account'];
    }
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
        <h2>Forgot Password</h2>
        <?php if (isset($_SESSION['message'])) {
            message();
        } ?>

        <form action="" method="post" >
            <div class="form-group">

                <input type="email" name="email" class="form-control form-control-lg " placeholder="Enter Email id"  />
            </div>




                <div class=" my-3">
                    <input type="submit" value="search" name="forgot" class=" text-white btn btn-success " class="btn btn-success text-white" >
                    <a href="login.php" class="btn btn-primary" >Cancel</a>

                </div>



        </form>

</div>
</div>
<?php

                    if (isset($_POST['forgot'])){


                    $email=mysqli_real_escape_string($conn , $_POST['email']);

                    $record_query = "SELECT * FROM admin WHERE email='{$email}'";
            $record = mysqli_query($conn , $record_query);
            $record_set = mysqli_fetch_assoc($record);
                    $record_count = mysqli_num_rows($record);

if (empty($email) ) {
           
                $_SESSION['message'] = "<li>Enter email address</li>" ;
           header("location:forgotpassword.php");
    }
    elseif ($record_count == 0 ) {
                $_SESSION['message'] = "<li>This email is not registered to any account, <br> enter valid email address</li>";
                header("location:forgotpassword.php");


    }   else{
                    $code = rand(100000,999999);
                    $to = "{$email}";
                    $subject = "Forgot Password";
                    $txt = "your Verification Code is \n\n\n $code";
                    $headers = "From: no-reply" . "\r\n";

                    if(mail($to,$subject,$txt,$headers)){


                    $query = "UPDATE admin SET verification='{$code}' WHERE id = {$record_set['id']}";
                    if(mysqli_query($conn , $query)){
                        $_SESSION['account'] = $record_set['username'];
                         header("location:verify.php?account=". urlencode($record_set['id']));
                      }else{
                        $_SESSION['message'] = $query1 .mysqli_error($conn). "\nplease try again";
                        header("location:login.php" );
                      }
                    }else{
                        $_SESSION['message'] = "something went wrong please try again ";
                      }

            }
                    }

?>
</body>

</html>