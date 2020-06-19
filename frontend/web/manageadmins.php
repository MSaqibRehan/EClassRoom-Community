<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
	include 'includes/layout/header.php';
?>
 <?php
   if (!isset($_SESSION['login_user'])) {
     $_SESSION['message'] = "<li class='text-danger font-weight-bold'>Login required!</li>";
     header("location:login.php");
   }
?> 
<div class="row" style="min-height: 520px;">
	<div class="col-md-2  bg-secondary pt-3">
      <?php 
      $comment_query = "SELECT * FROM comment WHERE status = 0 ";
             $comments = mysqli_query($conn , $comment_query);
             $comment_count = mysqli_num_rows($comments);
             
    ?>
		<ul class="nav flex-column text-white sidebar">
    <li class="nav-item">
      <a class="nav-link text-white " href="dashboard.php"><i class="fa fa-th pr-1"></i> Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="newpost.php"><i class="fa fa-list-alt pr-1"></i> Add New Post</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="categories.php"><i class="fa fa-tags pr-1"></i>Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white active" href="manageadmins.php"><i class="fa fa-user pr-2"></i>Manage Admins</a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="comments.php"><i class="fa fa-comment pr-2"></i>Comments <?php if($comment_count != 0){  echo "<span class='badge badge-warning p-2 ml-3'>".$comment_count."</span>"; } ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="index.php"><i class="fa fa-eye pr-2"></i>Live Blog</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out-alt pr-2"></i>logout</a>
    </li>
  </ul>
	</div>
	<div class="col-md-10">

    
    <?php
              if (isset($_SESSION['message'])) {
                message();
              }
            ?>

              <?php

               if (isset($_GET['query']) ) {
      
         $query = $_GET['query'];
    // gets value sent over search form

    $min_length = 3;
    // you can set minimum length of the query if you want

    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $query = mysqli_real_escape_string($conn , $query);
        // makes sure nobody uses SQL injection

        $record = mysqli_query($conn , "SELECT * FROM admin
            WHERE (`name` LIKE '%".$query."%') ") or die(mysqli_error($conn));

echo   "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
        if(mysqli_num_rows($record) == 0){
          $_SESSION['message'] =  "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
          $_SESSION['message'] .= "No record match this keyword";
          header("location:manageadmins.php");
        }
}else{
  $_SESSION['message'] .= "<p class='h4 text-warning'>Please enter atleat three letters to search</p>";
          header("location:manageadmins.php");
}}else{
      $query = "SELECT * FROM admin ORDER BY id DESC";
      $record = mysqli_query($conn , $query);
    ?>
      <p class="h2">Add New admin</p>
    <form action="" method="post" class="" >
      <div class="form-group">
        <label for="name">admin Name: </label>
        <input type="text" name="name" class="form-control" placeholder="Enter admin name" id="name" />
      </div>
      <div class="form-group">
        <label for="pass">admin password: </label>
        <input type="password" name="pass" class="form-control" placeholder="Enter admin password" id="pass" />
      </div>
      <div class="form-group">
        <label for="email">admin Email: </label>
        <input type="email" name="email" class="form-control" placeholder="Enter email address" id="email" />
      </div>
     
        <div class="form-group my-3">
          <input type="submit" value="Add New Admin" name="new_admin" class=" form-control btn btn-success text-white" >
          
        </div>



    </form>

<?php } ?>
         <div class="table-responsive"> 
       <table class="table table-striped w-100">
        <tr class="bg-secondary text-white">
          <th>Sr No.</th>
          <th>Date & Time</th>
          <th>Admin Name</th>
          <th>Admin email</th>
          <th>Creator Name</th>
          <th>Action</th>
        </tr>
        <?php
        $sr=1;
          while ($record_set =mysqli_fetch_assoc($record)) {
            $date = $record_set['date'];
            $name = $record_set['name'];
            $email = $record_set['email'];
            $creator = $record_set['added_by'];
              

        ?>
        <tr>
          <td><?php echo $sr; ?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $name; ?></td>
          <td><?php echo $email; ?></td>
          <td><?php echo $creator; ?></td>
          <td>
          <a class="btn btn-danger text-white" onclick="return confirm('Are you Sure?')" href="deleteadmin.php?admin=<?php echo urlencode($record_set['id']); ?>">Delete</a>
           </td>
          
        </tr>

      <?php
      $sr++;
          }

    ?>
       </table>
     </div>

	</div>
</div>
<?php
if (isset($_POST['new_admin'])) {
    $name = mysqli_real_escape_string($conn , $_POST['name']);
    $pass = mysqli_real_escape_string($conn , $_POST['pass']);
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    date_default_timezone_set("Asia/Karachi");
    $added_by = $_SESSION['login_user'];
 $date =  date("Y-m-d H:i:s");
    $re ="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";


    $record_query = "SELECT * FROM admin";
    $record = mysqli_query($conn , $record_query);
    $countset = -1;
   
    $mail_count = -1;
    while($record_set = mysqli_fetch_assoc($record)){
        if ($name == $record_set['username']) {
          $countset++;
        }
        if ($email == $record_set['email']) {
          $mail_count++;
        }
      }
      $lengthpass = strlen($pass);
      
    if (empty($name) || empty($pass) || (!preg_match("/^[a-zA-Z0-9]+$/" , $name)) || $lengthpass <5 || $countset != -1 ||  empty($email) || $mail_count != -1 || (!preg_match($re , $email))) {
      $_SESSION['message'] = null;
      if (empty($name)) {
        $_SESSION['message'] .= "<li>Enter user name</li>" ;
      }elseif (!preg_match("/^[a-zA-Z0-9]+$/" , $name)) {
        $_SESSION['message'] .= "<li>no white spaces and special characters are allowed for name</li>" ;
      }elseif ($length >= 40 ) {
        $_SESSION['message'] .= "<li>Username too long</li>" ;
      }elseif($countset != -1){
        $_SESSION['message'] .= "<li>Username already exist</li>" ;
      }

      if (empty($pass) || $lengthpass == -1){
        $_SESSION['message'] .= "<li>Enter Password</li>";
      } elseif($lengthpass < 5){
          $_SESSION['message'] .= "<li>Password must be atleat five characters</li>" ;
      }
      if (empty($email)) {
        $_SESSION['message'] .= "<li>Enter Email Address</li>" ;
      }elseif ($mail_count != -1) {
        $_SESSION['message'] .= "<li>Email Address Already Exist , use another email</li>" ;
      }elseif (!preg_match($re , $email)) {
        $_SESSION['message'] .= "<li>invalid Email Address</li>" ;
      }
      
    
    header("location:manageadmins.php");


    }else{

    $pass = md5($pass);
    $query = "INSERT INTO admin (name , password ,email, added_by , date ) VALUES ('{$name}' , '{$pass}' ,'{$email}' , '{$added_by}' , '{$date}')";
    if (!mysqli_query($conn , $query)) {
      $_SESSION['message'] = "error:" . $query . "<br>". mysqli_error($conn);
      header("location:manageadmins.php");
    }else {
      $_SESSION['message'] = 'admin created success';
      header("location:manageadmins.php");
    }}
  }
?>
<?php include 'includes/layout/footer.php'; ?>