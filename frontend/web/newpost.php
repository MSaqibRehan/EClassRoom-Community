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
      <a class="nav-link text-white active" href="newpost.php"><i class="fa fa-list-alt pr-1"></i> Add New Post</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="categories.php"><i class="fa fa-tags pr-1"></i>Categories</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="manageadmins.php"><i class="fa fa-user pr-2"></i>Manage Admins</a>
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

    <p class="h2">Add New Posts</p>
            <?php 
              if (isset($_SESSION['message'])) {
                message();
              }
            ?>
      <form action="" method="post" class="w-75 mx-auto" enctype="multipart/form-data" >
        <div class="form-group">
          <label for="title">Post Title</label>
          <input type="text" name="title" class="form-control"  placeholder="Enter Post Title">
        </div>
        <div>
          <label for="categ">Select Category</label>
        <select name="category" class="custom-select" id="categ">
          <option value="-1" >--- Select Categories ---</option>
          <?php
            $categories = mysqli_query($conn , "SELECT * FROM category");
            while ($row = mysqli_fetch_assoc($categories)) {
              ?>
                <option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option>
              <?php
            }
          ?>
        </select>
        </div>
        <div class="form-group">
          <label for="image">Select Banner image</label>
          <input type="file" name="image" class="form-control" id="image" placeholder="Enter Post Title">
        </div>
        <div class="form-group">
          <label for="text">Post Content</label>
          <textarea name="content" class="form-control" rows="4" placeholder="Enter Content here"></textarea>
        </div>
        <div class="form-group form-inline">
          <input type="submit" name="newpost" value="Create Post" class="btn btn-primary w-50">
          <a class="btn btn-danger w-50" href="dashboard.php">Cancel</a>
        </div>



      </form>
	</div>
</div>
<?php
if (isset($_POST['newpost'])) {
  
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
 if (empty($title) || $category == -1 || !preg_match("/^[a-zA-Z 0-9#;]+$/" , $title)  || empty($imagename) ||$_FILES["image"]["size"] > 2000000 || $ext == 'false' ) {
      $_SESSION['message'] = null;
      if (empty($title)) {
        $_SESSION['message'] .= "<li>Enter user name</li>" ;
      }elseif (!preg_match("/^[a-zA-Z 0-9$;]+$/" , $title)) {
       $_SESSION['message'] .= "<li>no special characters are allowed for title</li>" ;
      }

      if ( $category == -1){
        $_SESSION['message'] .= "<li>Please Select Category</li>";
      }
      if (empty($imagename)) {
       $_SESSION['message'] .= "<li>Select an Image</li>" ;
      }elseif ($_FILES["image"]["size"] > 2000000) {
          $_SESSION['message'] .= "<li>Sorry, your file is too large.</li>";
        }elseif($ext == 'false'){
        $_SESSION['message'] .= "<li>Please Select .png/.jpg/.gif/.btm format image</li>";
      }

      
        header("location:newpost.php");
      

    
    }elseif(move_uploaded_file($temp_name, $target_path)){
      $query = "INSERT INTO posts (date ,title,category,author,image,content) VALUES('{$date}' , '{$title}' , '{$category}' , '{$author}' , '{$target_path}' , '{$content}')";
      if (mysqli_query($conn , $query)) {
        $_SESSION['message'] = "New Post Added";
        header("location:dashboard.php");
      }else{
        $_SESSION['message'] = mysqli_error($conn);
        header("location:newpost.php");
      }
    }
  }





?>
<?php include 'includes/layout/footer.php'; ?>