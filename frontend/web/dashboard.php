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
      <a class="nav-link text-white active" href="dashboard.php"><i class="fa fa-th pr-1"></i> Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="newpost.php"><i class="fa fa-list-alt pr-1"></i> Add New Forum</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="categories.php"><i class="fa fa-tags pr-1"></i>Categories</a>
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
 
    <p class="h2">Manage Posts</p>
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

        $record = mysqli_query($conn , "SELECT * FROM posts
            WHERE (`title` LIKE '%".$query."%') ") or die(mysqli_error($conn));

echo   "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
        if(mysqli_num_rows($record) == 0){
          $_SESSION['message'] =  "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
          $_SESSION['message'] .= "No record match this keyword";
          header("location:dashboard.php");
        }
}else{
  $_SESSION['message'] .= "<p class='h4 text-warning'>Please enter atleat three letters to search</p>";
          header("location:dashboard.php");
}}else{
      $query = "SELECT * FROM posts ORDER BY id DESC";
      $record = mysqli_query($conn , $query);
    }
    ?>
      <div class="table-responsive"> 
      <table class="table table-striped w-100 table-secondary">
        <tr class="bg-secondary text-white">
          <th>No</th>
          <th width="200">Post Title</th>
          <th width="150">Date & Time</th>
          <th>Author</th>
          <th>Category</th>
          <th>Banner</th>
          <th>Comments</th>
          <th>Action</th>
          <th>Details</th>
        </tr>
        <?php 
        $sr=1;
          while ($record_set =mysqli_fetch_assoc($record)) {
             $comment_query = "SELECT * FROM comment WHERE post_id = {$record_set['id']} ";
             $comments = mysqli_query($conn , $comment_query);
             $comments_approved = 0;
             $comments_disapproved  = 0;
             while($comments_record = mysqli_fetch_assoc($comments)){
              if ($comments_record['status'] == 1) {
                $comments_approved++;
              }

              if ($comments_record['status'] == 0) {
                $comments_disapproved++;
              }
             }    
             
              $title = $record_set['title'];
              $date = $record_set['date'];
              $category = $record_set['category'];
              $author = $record_set['author'];
              $image = $record_set['image'];
          
        ?>
        <tr>
          <td><?php echo $sr; ?></td>
          <td class="text-primary font-weight-bold"><?php echo $title; ?></td>
          <td><?php echo $date; ?></td>
          <td><?php echo $author; ?></td>
          <td><?php echo $category; ?></td>
          <td><img src="<?php echo $image; ?>" alt="" width="100" height="50"></td>
          <td><?php if ($comments_disapproved != 0 ) {
            echo "<span class='badge badge-danger p-2 float-left'>".$comments_disapproved."</span>";
          }if ($comments_approved != 0 ) {
            echo "<span class='badge badge-success p-2 float-right'>".$comments_approved."</span>";
          } ?></td>
          <td><a class="btn btn-warning text-white" href="editpost.php?post=<?php echo urlencode($record_set['id']); ?>">Edit</a>
          <a class="btn btn-danger text-white" onclick="return confirm('Are you Sure?')" href="deletepost.php?post=<?php echo urlencode($record_set['id']); ?>">Delete</a>
           </td>
          <td><a target="_blank" class="btn btn-primary text-white" href="fullpost.php?post=<?php echo urlencode($record_set['id']); ?>">Live Preview</a></td>
        </tr>
   
      <?php
      $sr++;
          }

    ?>
       </table>
     </div>
		
	</div>
</div>

<?php include 'includes/layout/footer.php'; ?>