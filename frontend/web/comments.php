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
<?php 
    if (isset($_GET['approve'])) {
      $approve_id = mysqli_real_escape_string($conn , $_GET['approve']);
      $disapprove_id = null;
      $delete_id = null;
    }elseif (isset($_GET['disapprove'])) {
      $disapprove_id = mysqli_real_escape_string($conn , $_GET['disapprove']);
      $approve_id = null;
      $delete_id = null;
    }elseif (isset($_GET['delete'])) {
      $delete_id = mysqli_real_escape_string($conn , $_GET['delete']);
      $approve_id = null;
      $disapprove_id = null;
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
      <a class="nav-link text-white" href="manageadmins.php"><i class="fa fa-user pr-2"></i>Manage Admins</a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-white  active" href="comments.php"><i class="fa fa-comment pr-2"></i>Answers <?php if($comment_count != 0){  echo "<span class='badge badge-warning p-2 ml-3'>".$comment_count."</span>"; } ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="logout.php"><i class="fa fa-sign-out-alt pr-2"></i>logout</a>
    </li>
  </ul>
  </div>
  <div class="col-md-10 " >
       <?php
              if (isset($_SESSION['message'])) {
                message();
              }
            ?>
    <p class="h2">DisApproved Answers</p>
   
    <?php
    if (isset($_GET['query']) && isset($_GET['submit']) ) {
      
         $query = $_GET['query'];
    // gets value sent over search form

    $min_length = 3;
    // you can set minimum length of the query if you want

    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $query = mysqli_real_escape_string($conn , $query);
        // makes sure nobody uses SQL injection

        $record = mysqli_query($conn , "SELECT * FROM comment
            WHERE (`comment` LIKE '%".$query."%') AND status = 0  ") or die(mysqli_error($conn));
$disapprove_count = mysqli_num_rows($record);
echo  "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
        if(mysqli_num_rows($record) == 0){
         echo  "No DisApproved Answers match this keyword";
         
        }
}else{
  $_SESSION['message'] .= "<p class='h4 text-warning'>Please enter atleat three letters to search</p>";
          header("location:comments.php");
}}else{
      $query = "SELECT * FROM comment WHERE status = 0 ORDER BY id DESC ";
      $record = mysqli_query($conn , $query);
      $disapprove_count = mysqli_num_rows($record);
    }
    ?>
    <div class="table-responsive">
      <table class="table table-striped " >
        <tr class="bg-secondary text-white">
          <th>Sr No.</th>
          <th>Date</th>
          <th>Name</th>
          <th>Answer</th>
          <th>Approve</th>
          <th>Action</th>
          <th>Detail</th>
        </tr>
        <?php
        if ($disapprove_count == 0) {
          echo "<tr><td colspan='7' class='font-weight-bold text-center'>No DisApproved Answers</td></tr>";
        }else{
        $sr=1;
          while ($record_set =mysqli_fetch_assoc($record)) {
              $name = $record_set['username'];
              $date = $record_set['date'];
              $comment = $record_set['comment'];
              

        ?>
        <tr>
          <td><?php echo $sr; ?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $name; ?></td>
          <td><?php echo $comment; ?></td>
          <td>
          <a class="btn btn-success text-white" href="?approve=<?php echo urlencode($record_set['id']); ?>">Approve</a>
           </td>
           <td>
          <a class="btn btn-danger text-white" onclick="return confirm('Are you Sure?')" href="?delete=<?php echo urlencode($record_set['id']); ?>">Delete</a>
           </td>
           <td>
           </td>
          
        </tr>

      <?php
      $sr++;
          }}

    ?>
       </table>
       </div>
       <br><hr><br>
 <p class="h2">Approved Answers</p>
   
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

        $record = mysqli_query($conn , "SELECT * FROM comment WHERE comment LIKE '%$query%' AND status = 1") or die(mysqli_error($conn));
 $approve_count = mysqli_num_rows($record);
echo  "<h2>Search Records For keyword : ".$query."</h2>";
        if(mysqli_num_rows($record) == 0 &&  $approve_count == 0 ){
          echo  "No Approved Answers match this keyword";
          
        }
}else{
  $_SESSION['message'] .= "Please enter atleat three letters";
          header("location:comments.php");
}}else{
      $query = "SELECT * FROM comment WHERE status = 1 ORDER BY id DESC ";
      $record = mysqli_query($conn , $query);
      $approve_count = mysqli_num_rows($record);
    }
    ?>
    <div class="table-responsive">
      <table class="table table-striped  w-100">
        <tr class="bg-secondary text-white">
          <th>Sr No.</th>
          <th>Date</th>
          <th>Name</th>
          <th>Answers</th>
          <th>Approved_by</th>
          <th>Retrive approval</th>
          <th>Action</th>
          <th>Detail</th>
        </tr>
        <?php
         if ($approve_count == 0) {
          echo "<tr><td colspan='7' class='font-weight-bold text-center'>No Approved Answers</td></tr>";
        }else{
        $sr=1;
          while ($record_set =mysqli_fetch_assoc($record)) {
              $name = $record_set['username'];
              $comment = $record_set['comment'];
              $date = $record_set['date'];
              $author = $record_set['approved_by'];
              

        ?>
         <tr>
          <td><?php echo $sr; ?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $name; ?></td>
          <td><?php echo $comment; ?></td>
          <td><?php echo $author; ?></td>
          <td>
          <a class="btn btn-warning text-white"  href="?disapprove=<?php echo urlencode($record_set['id']); ?>">DisApprove</a>
           </td>
           <td>
          <a class="btn btn-danger text-white" onclick="return confirm('Are you Sure?')" href="?delete=<?php echo urlencode($record_set['id']); ?>">Delete</a>
           </td>
           <td>
          <a target="_blank" class="btn btn-primary text-white" href="fullpost.php?post=<?php echo urlencode($record_set['post_id']); ?>">Live Preview</a>
           </td>
          
        </tr>

      <?php
      $sr++;
          }}

    ?>
       </table>
       </div>
  </div>
</div>
<?php 
    if (isset($approve_id)) {
      $author = $_SESSION['login_user'];
      $query = "UPDATE comment SET status ='1' , approved_by ='{$author}' WHERE id = {$approve_id}  ";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "Answer Approved";
        header("location:comments.php");
      }else{
        $_SESSION['message'] = $query . mysqli_error($conn);
        header("location:comments.php");
      }
    }elseif (isset($disapprove_id)) {
       $query = "UPDATE comment SET status ='{0}' , approved_by =null WHERE id = {$disapprove_id} ";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "Answer DisApproved";
        header("location:comments.php");
      }else{
        $_SESSION['message'] = $query .mysqli_error($conn);
        header("location:comments.php");
      }
    }elseif (isset($delete_id)) {
       $query = "DELETE FROM comment WHERE id = {$delete_id}";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "Answer Deleted";
        header("location:comments.php");
      }else{
        $_SESSION['message'] =$query . mysqli_error($conn);
        header("location:comments.php");
      }
    }
?>

<?php include 'includes/layout/footer.php'; ?>