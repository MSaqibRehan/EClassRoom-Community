<?php
  include 'includes/config.php';
	include 'includes/layout/header.php';
   include 'includes/sessions.php';
?>
<?php 
   if (!isset($_SESSION['login_user'])) {
     $_SESSION['message'] = "<li class='text-danger font-weight-bold'>Login required!</li>";
     header("location:login.php");
   }
?>
<?php
    function GetImageExtension($imagetype)
    {
       if(empty($imagetype)) return false;
       switch($imagetype)
       {
           case 'image/bmp': return '.bmp';
           case 'image/gif': return '.gif';
           case 'image/jpeg': return '.jpg';
           case 'image/png': return '.png';
           default: return false;
       }

     }
?>
<?php 
  if (isset($_GET['post'])) {
    $post_id = $_GET['post'];
    $safe_post_id = mysqli_real_escape_string($conn , $post_id);
  }
 
?>
<div class="row" style="min-height: 520px;">
	<div class="col-md-2  bg-secondary pt-3">
		<ul class="nav flex-column text-white sidebar">
    <li class="nav-item">
      <a class="nav-link text-white active" href="dashboard.php"><i class="fa fa-th pr-1"></i> Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white " href="newpost.php"><i class="fa fa-list-alt pr-1"></i> Add New Post</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="categories.php"><i class="fa fa-tags pr-1"></i>Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="manageadmins.php"><i class="fa fa-user pr-2"></i>Manage Admins</a>
    </li>
     <li class="nav-item">
      <a class="nav-link text-white" href="comments.php"><i class="fa fa-comment pr-2"></i>Answers</a>
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
    <p class="h2">Edit Posts</p>
            
            <?php 
              $record_query = "SELECT * FROM posts WHERE id = {$post_id}";
              $record = mysqli_query($conn , $record_query);
              $record_set = mysqli_fetch_assoc($record);

            ?>
      <form action="" method="post" class="w-75 mx-auto" enctype="multipart/form-data" >
        <div class="form-group">
          <label for="title">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $record_set['author_email'] ?>"  placeholder="Enter Your Email">
        </div>
        <div class="form-group">
          <label for="title">Question</label>
          <input type="text" name="title" class="form-control" value="<?php echo $record_set['title'] ?>"  placeholder="Enter Question">
        </div>
        <div class="my-2">
          <label for="categ">Select Category</label>
        <select name="category" class="custom-select" id="categ">
          
          <?php
            $categories = mysqli_query($conn , "SELECT * FROM category");
            while ($row = mysqli_fetch_assoc($categories)) {
              ?>
                <option value="<?php echo $row['name']; ?>" <?php if ($row['name'] == $record_set['title']) {
                  echo "selected";
                } ?>><?php echo $row['name']; ?></option>
              <?php
            }
          ?>
        </select>
        </div>
        
        <div class="form-group my-2">
          <label for="text">Description</label>
          <textarea name="content" class="form-control" rows="4" placeholder="Enter Description here"><?php echo $record_set['content']; ?></textarea>
        </div>
        <div class="form-group form-inline">
          <input type="submit" name="edit" value="UPDATE" class="btn btn-primary w-50">
          <a class="btn btn-danger w-50" href="dashboard.php">Cancel</a>
        </div>



      </form>
	</div>
</div>
<?php
if (isset($_POST['edit'])) {
  
  $title = mysqli_real_escape_string($conn , $_POST['title']);
  $category = mysqli_real_escape_string($conn , $_POST['category']);
  $content = mysqli_real_escape_string($conn , $_POST['content']);
 
  date_default_timezone_set("Asia/Karachi");
  $date =  date("Y-m-d H:i:s");
  $author = $_SESSION['login_user'];


 if (empty($title) || $category == -1 || !preg_match("/^[a-zA-Z 0-9]+$/" , $title)  || empty($content)  ) {
      $_SESSION['message'] = null;
      if (empty($title)) {
        $_SESSION['message'] .= "<li>Enter post title</li>" ;
      }elseif (!preg_match("/^[a-zA-Z 0-9]+$/" , $title)) {
       $_SESSION['message'] .= "<li>no special characters are allowed for title</li>" ;
      }

      if ( $category == -1){
        $_SESSION['message'] .= "<li>Please Select Category</li>";
      }
      if (empty($email)) {
        $_SESSION['message'] .= "<li>Please Enter Your Email Address</li>"; 
      }
      if (empty($content)) {
        $_SESSION['message'] .= "<li>Please Enter Description</li>"; 
      }

           
header("editpost.php?post=".urlencode($safe_post_id));
    
    }else{
         $query = "UPDATE posts SET date = '{$date}' , title = '{$title}' , category = '{$category}' , author = '{$author}', author_email = '{$email}' , content = '{$content}' WHERE id = {$safe_post_id}";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "Post Updated";
        header("location:dashboard.php");
      }else{
        $_SESSION['message'] = $query .mysqli_error($conn);
        header("editpost.php?post=".urlencode($safe_post_id));
        }
      }
    }
  





?>
<?php include 'includes/layout/footer.php'; ?>