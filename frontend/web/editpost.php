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
      <a class="nav-link text-white" href="comments.php"><i class="fa fa-comment pr-2"></i>Comments</a>
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
    <p class="h2">Edit Posts</p>
            
            <?php 
              $record_query = "SELECT * FROM posts WHERE id = {$post_id}";
              $record = mysqli_query($conn , $record_query);
              $record_set = mysqli_fetch_assoc($record);

            ?>
      <form action="" method="post" class="w-75 mx-auto" enctype="multipart/form-data" >
        <div class="form-group">
          <label for="title">Post Title</label>
          <input type="text" name="title" class="form-control" value="<?php echo $record_set['title'] ?>"  placeholder="Enter Post Title">
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

          
           <p>Previous Banner:<img src="<?php echo $record_set['image']; ?>" width="100px" height="50" ></p>
          <label for="image">Select Banner image</label>
          <input type="file" name="image" class="form-control" id="image" placeholder="Enter Post Title">
        </div>
        <div class="form-group my-2">
          <label for="text">Post Content</label>
          <textarea name="content" class="form-control" rows="4" placeholder="Enter Content here"><?php echo $record_set['content']; ?></textarea>
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
  $file_name=$_FILES["image"]["name"];
  $temp_name=$_FILES["image"]["tmp_name"];
  $imgtype=$_FILES["image"]["type"];
  $ext= GetImageExtension($imgtype);
  $imagename=$_FILES["image"]["name"];
  $target_path = "images/".$imagename;
  date_default_timezone_set("Asia/Karachi");
  $date =  date("Y-m-d H:i:s");
  $author = $_SESSION['login_user'];

  $target_path = "images/".$imagename;
 if (empty($title) || $category == -1 || !preg_match("/^[a-zA-Z 0-9]+$/" , $title)  ||( empty($imagename) && $record_set['image'] == null) ||$_FILES["image"]["size"] > 2000000 || $ext == 'false' ) {
      $_SESSION['message'] = null;
      if (empty($title)) {
        $_SESSION['message'] .= "<li>Enter post title</li>" ;
      }elseif (!preg_match("/^[a-zA-Z 0-9]+$/" , $title)) {
       $_SESSION['message'] .= "<li>no special characters are allowed for title</li>" ;
      }

      if ( $category == -1){
        $_SESSION['message'] .= "<li>Please Select Category</li>";
      }
      if (empty($imagename) && $record_set['image'] == "") {
       $_SESSION['message'] .= "<li>Select an Image</li>" ;
      }elseif ($_FILES["image"]["size"] > 2000000) {
          $_SESSION['message'] .= "<li>Sorry, your file is too large.</li>";
        }elseif($ext == 'false'){
        $_SESSION['message'] .= "<li>Please Select .png/.jpg/.gif/.btm format image</li>";
      }

           
header("editpost.php?post=".urlencode($safe_post_id));
    
    }elseif($record_set['image'] != "" && empty($imagename)){
      $query = "UPDATE posts SET date = '{$date}' , title = '{$title}' , category = '{$category}' , author = '{$author}', content = '{$content}' WHERE id = {$safe_post_id}";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "Post Updated";
        header("location:dashboard.php");
      }else{
         $_SESSION['message'] = $query .mysqli_error($conn);
        header("editpost.php?post=".urlencode($safe_post_id));
      }}else{
        unlink($record_set['image']);
        move_uploaded_file($temp_name, $target_path);
         $query = "UPDATE posts SET date = '{$date}' , title = '{$title}' , category = '{$category}' , author = '{$author}', image = '{$target_path}' , content = '{$content}' WHERE id = {$safe_post_id}";
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