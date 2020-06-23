<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
	include 'includes/layout/index_header.php';
?>
<?php if(isset($_GET['post'])){
  $post_id =  mysqli_real_escape_string($conn, $_GET['post']);
} ?>
<div class="row" style="min-height: 520px;">
  <div class="col-md-9 pl-5">
<div style="width: 85%;" class="row   my-3 mx-auto ">
    
          <div class="row w-100"> <?php 
    if (isset($_SESSION['message'])) {
      message();
    }
  ?></div>
    <?php
      $record = mysqli_query($conn , "SELECT * FROM posts WHERE id = {$post_id}");
      while ($record_set = mysqli_fetch_assoc($record)) {

        $comment = mysqli_query($conn , "SELECT * FROM comment WHERE status = 1 AND post_id = {$post_id}");
        $comment_count = mysqli_num_rows($comment);
        ?>
        <div class='row my-2 w-100 m-0 p-3' style="background:   #E6E6FA;">
          <div class="col-12" >

          
          <div class="row ">
            <div class="col-12">
              <h3 class="h1 text-primary font-italic">Question : <?php echo $record_set['title']; ?> </h3>
            </div> 
          </div><br>
          <div class="row">
            <div class="col-12">
              <p class="text-secondary font-weight-bold w-100">Category : <?php echo $record_set['category']; ?> Published On : <?php echo $record_set['date']; ?> <span class="float-right badge badge-secondary text-right"> Answers :<?php echo $comment_count; ?></span></p>
            </div>
            
          </div>
          <div class="row">
            <div class="col-12">
              <h3 class="text-dark">DESCRIPTION </h3>
               <p class="text-justify" style="font-size:22px !important;"><?php echo $record_set['content']; ?></p>
            </div>
           
          </div>


</div>
        </div>
        <hr>

        <?php
      }
        ?>



<div class="row w-100 mt-5 bg-light p-3 ml-1 border-secondary">
  <h4 class=" text-warning w-100">Answers:</h4><br>
   <?php
      $query = "SELECT * FROM comment WHERE status = 1 AND post_id= $post_id ORDER BY id DESC ";
      $record = mysqli_query($conn , $query);
      $comment_count = mysqli_num_rows($record);
      if ($comment_count == 0 ) {
        echo "<p class=' text-warning text-center'>No comments on this post</p>";
      }else{
          while ($record_set = mysqli_fetch_assoc($record)) {
          ?>
        <div class="row w-100 my-2">
          <div class="col-12  ">
            <p class="h2 mb-0">Answer By : <?php echo $record_set['username']; ?></p>
            <p class="text-secondary mb-0" style="font-size: 12px;"> <?php echo $record_set['date']; ?></p>
            <p style="font-size: 22px; text-indent: 50px;"> <?php echo $record_set['comment']; ?></p>
          </div>
        </div>
          <?php
      }}
    ?>
</div>
 <div class="row w-100 mt-5 bg-light p-3 ml-1 border-secondary">
  <div class="col-12">
    <form action="" method="post" class="w-100 mt-3" >
      <p class="h5 text-warning">Share Your Thoughts With us</p>
        <div class="form-group">
          <label for="name" class="text-warning">Name: </label>
          <input type="text" name="name" class="form-control" placeholder="Enter Your name" id="name" />
        </div>
        <div class="form-group">
          <label for="email" class="text-warning">Email: </label>
          <input type="email" name="email" class="form-control" placeholder="Enter Your Email" id="email" />
        </div>
        <div class="form-group">
          <label for="comment" class="text-warning">Comment: </label>
          <textarea id="comment" name="comment" placeholder="Enter Comment" class="form-control" rows="4"></textarea>

        </div>

          <div class="form-group my-3">
            <input type="submit" value="Submit Comment" name="submit_comment" class=" form-control btn btn-success text-white" >

          </div>



      </form>
    </div>
</div>
</div>
  </div>
  <div class="col-md-2 justify-content-start my-5">
    
    <div class="row my-3">
      <?php
        $category = mysqli_query($conn, "SELECT * FROM category");
      ?>
      <div class="card border-primary w-100">
        <div class="card-header bg-primary text-white">
          <p class="h3">Categories</p>
        </div>
        <div class="card-body ">
          <?php
            while ($row = mysqli_fetch_assoc($category)) {
                ?>
              <a class="font-weight-bold text-primary" href="category.php?category=<?php echo urlencode($row['name']); ?>"><?php echo $row['name']; ?></a><br>
                <?php
            }
          ?>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
        $post = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC LIMIT 5");
      ?>
      <div class="card border-primary w-100">
        <div class="card-header bg-primary text-white">
          <p class="h3">Rescent Posts</p>
        </div>
        <div class="card-body ">
          <?php
            while ($row = mysqli_fetch_assoc($post)) {
                ?>
                <div class="row my-2">
                <div class="col-5 p-0 m-0">
                  <img src="<?php echo $row['image']; ?>" class="w-100 m-0">
                </div>
                <div class="col-7 p-0">
                  <a href="fullpost.php?post=<?php echo urlencode($row['id']); ?>" class="px-2 font-weight-bold text-dark mt-0"><?php echo $row['title']; ?></a>
                  <p class="text-dark px-2" style="font-size: 10px;"><?php echo $row['date']; ?></p>
                </div>
                </div>
              <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>

</div>
<?php
  if (isset($_POST['submit_comment'])) {
    $name = mysqli_real_escape_string($conn , $_POST['name']);
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    $comment = mysqli_real_escape_string($conn , $_POST['comment']);
     date_default_timezone_set("Asia/Karachi");
    $date =  date("Y-m-d H:i:s");
    $re ="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

    if (empty($name) || empty($email) ||  empty($comment) || (!preg_match("/^[a-zA-Z 0-9]+$/" , $name)) || (!preg_match($re , $email))) {
      $_SESSION['message'] = null;
      if (empty($name)) {
        $_SESSION['message'] .= "<li>Enter Your name</li>" ;
      }elseif (!preg_match("/^[a-zA-Z0-9]+$/" , $name)) {
        $_SESSION['message'] .= "<li>No special characters are allowed for name</li>" ;
      }

      
      if (empty($email)) {
        $_SESSION['message'] .= "<li>Enter Email Address</li>" ;
      }elseif (!preg_match($re , $email)) {
        $_SESSION['message'] .= "<li>invalid Email Address</li>" ;
      }
      if (empty($comment) ){
        $_SESSION['message'] .= "<li>Enter Comment Content</li>";
      } 


    header("location:fullpost.php?post=". urlencode($post_id));


    }else{


    $query = "INSERT INTO comment (username ,email ,comment , status , post_id , date ) VALUES ('{$name}' , '{$email}' ,'{$comment}' , '{0}' ,{$post_id} , '{$date}')";
    if (!mysqli_query($conn , $query)) {
      $_SESSION['message'] = "error:" . $query . "<br>". mysqli_error($conn);
    header("location:fullpost.php?post=". urlencode($post_id));
    }else {
      $_SESSION['message'] = 'Comment Submit Success';
    header("location:fullpost.php?post=". urlencode($post_id));    }}
  }
?>
<?php include 'includes/layout/footer.php'; ?>