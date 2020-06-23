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
      <a class="nav-link text-white" href="newpost.php"><i class="fa fa-list-alt pr-1"></i> Add New Forum</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white active" href="categories.php"><i class="fa fa-tags pr-1"></i>Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="manageadmins.php"><i class="fa fa-user pr-2"></i>Manage Admins</a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="comments.php"><i class="fa fa-comment pr-2"></i>Answers<?php if($comment_count != 0){  echo "<span class='badge badge-warning p-2 ml-3'>".$comment_count."</span>"; } ?></a>
    </li>

    <li class="nav-item">
      <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out-alt pr-2"></i>logout</a>
    </li>
  </ul>
  </div>
  <div class="col-md-10">

    <p class="h2">Manage Categories</p>
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

        $record = mysqli_query($conn , "SELECT * FROM category
            WHERE (`name` LIKE '%".$query."%') ") or die(mysqli_error($conn));

echo   "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
        if(mysqli_num_rows($record) == 0){
          $_SESSION['message'] =  "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
          $_SESSION['message'] .= "No record match this keyword";
          header("location:categories.php");
        }
}else{
  $_SESSION['message'] .= "<p class='h4 text-warning'>Please enter atleat three letters to search</p>";
          header("location:categories.php");
}}else{
      $query = "SELECT * FROM category ORDER BY id DESC";
      $record = mysqli_query($conn , $query);
    ?>
    <form action="" method="post">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
      </div>
      <div class="form-group">
        <input type="submit" name="create" value="Create Category" class="form-control bg-success text-white">
      </div>
    </form>
<?php } ?>


     <div class="table-responsive"> 
      <table class="table table-striped w-100">
        <tr class="bg-secondary text-white">
          <th>Sr No.</th>
          <th>Date & Time</th>
          <th>Category Name</th>
          <th>Creator Name</th>
          <th>Action</th>
        </tr>
        <?php
        $sr=1;
          while ($record_set =mysqli_fetch_assoc($record)) {
              $title = $record_set['name'];

              $date = $record_set['date'];
              $author = $record_set['creator'];
              

        ?>
        <tr>
          <td><?php echo $sr; ?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $title; ?></td>
          <td><?php echo $author; ?></td>
          <td>
          <a class="btn btn-danger text-white" onclick="return confirm('Are you Sure?')" href="deletecategory.php?category=<?php echo urlencode($record_set['id']); ?>">Delete</a>
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


<?php if (isset($_POST['create'])) {
    $name = mysqli_real_escape_string($conn , $_POST['name']);
    date_default_timezone_set("Asia/Karachi");
  $date =  date("Y-m-d H:i:s");
    $creator = $_SESSION['login_user'];
    $length = strlen($name);
     $record_query = "SELECT * FROM category";
      $record = mysqli_query($conn , $record_query);
      $name_count = -1;
      while($record_set = mysqli_fetch_assoc($record)){
        if ($name == $record_set['name'] ) {
          $name_count++;
        }
      }
    if (empty($name) || $length > 20 || $name_count != -1  ) {
      $_SESSION['message'] = null;
      if (empty($name)) {
        $_SESSION['message'] .= "<li>Please Enter Category Name</li>";
      }elseif ($length > 20) {
        $_SESSION['message'] .= "<li>Category Name too long</li>";
      }elseif ($name_count != -1) {
        $_SESSION['message'] .= "<li>Category Already Exist</li>";
      }

      header("location:categories.php");
    }else{
      $query = "INSERT INTO category (date , name , creator) VALUES('{$date}' , '{$name}' , '{$creator}')";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "Category Inserted";
        header("location:categories.php");
      }else{
        $_SESSION['message'] = mysqli_error($conn);
        header("location:categories.php");
      }
    }
} ?>

<?php include 'includes/layout/footer.php'; ?>