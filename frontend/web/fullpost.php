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
  <h4 class=" text-info w-100">Answers:</h4><br>
   <?php
      $query = "SELECT * FROM comment WHERE status = 1 AND post_id= $post_id ORDER BY id DESC ";
      $record = mysqli_query($conn , $query);
      $comment_count = mysqli_num_rows($record);
      if ($comment_count == 0 ) {
        echo "<p class=' text-info text-center'>No Answers on this post</p>";
      }else{
          while ($record_set = mysqli_fetch_assoc($record)) {
          ?>
        <div class="row w-100 my-2">
          <div class="col-12  ">
            <p class="h3 mb-0 py-2 bg-info text-white">Answer By : <?php echo $record_set['username']; ?></p>
            <p class="text-secondary mb-0" style="font-size: 15px;"> <?php echo $record_set['date']; ?></p>
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
      <p class="h5 text-success">Share Your Thoughts With us</p>
        <div class="form-group">
          <label for="name" class="text-success">Name: </label>
          <input type="text" name="name" class="form-control" placeholder="Enter Your name" id="name" />
        </div>
        <div class="form-group">
          <label for="email" class="text-success">Email: </label>
          <input type="email" name="email" class="form-control" placeholder="Enter Your Email" id="email" />
        </div>
        <div class="form-group">
          <label for="comment" class="text-success">Answer: </label>
          <textarea id="comment" name="comment" placeholder="Enter Your Answer" class="form-control" rows="4"></textarea>

        </div>

          <div class="form-group my-3">
            <input type="submit" value="Submit Answer" name="submit_comment" class=" form-control btn btn-success text-white" >

          </div>



      </form>
    </div>
</div>
</div>
  </div>
   <div class="col-md-2 justify-content-start my-5">
    <div class="row my-2">
 
      <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-block font-weight-bold btn-lg" data-toggle="modal" data-target="#exampleModal">
  Add New Forum
</button>

<!-- Modal -->
<div class="modal  fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Forum</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" >
          <div class="form-group">
            <label class="form-control-label">Your Name</label> 
            <input type="text" class="form-control" id="name1" name="name" placeholder="Enter Your Name"> 
            
          </div>
      <span class="errname"></span>
          <div class="form-group">
            <label class="form-control-label">Your Email</label> 
            <input type="email" class="form-control" id="email1" name="email" placeholder="Enter Your Email Address"> 
            <span class="erremail"></span>
          </div>
          <div class="form-group">
            <label class="form-control-label">Your Question</label> 
            <input type="text" class="form-control" id="question1" name="question"> 
            <span class="errquestion"></span>
          </div>
          <div class="form-group">
            <label class="form-control-label">Category</label> 
            <input type="text" class="form-control" id="category1" name="category"> 
            <span class="errcategory"></span>
          </div>
          <div class="form-group">
            <label class="form-control-label">Description</label> 
            <textarea name="description" id="description1" rows="4" class="form-control" placeholder="Please Describe Your Question"></textarea>
            <span class="errdescription"></span>
          </div>
          <span class="message_box"></span>
          
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="createforum">Save Forum</button>
      </div>
    </div>
  </div>
</div>
    </div>
    
    
    <div class="row">
      <?php
        $post = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC LIMIT 10");
      ?>
      <div class="card border-info w-100">
        <div class="card-header bg-info text-white">
          <p class="h3">Rescent Forums</p>
        </div>
        <div class="card-body ">
          <?php
            while ($row = mysqli_fetch_assoc($post)) {
              $answer = mysqli_query($conn, "SELECT * FROM comment WHERE status = '1' and post_id = '".$row['id']."'");
              $num_rows = mysqli_num_rows($answer);
            

                ?>
                <div class="row my-2">
                
                <div class="col-12 p-0">
                  <a href="fullpost.php?post=<?php echo urlencode($row['id']); ?>" class="px-2 font-weight-bold text-dark mt-0"><?php echo $row['title']; ?></a>
                  <p class="text-dark px-2" style="font-size: 10px;"><?php echo $row['date']; ?> || Answers : <?php echo $num_rows ?></p>
                </div>
                </div>
              <?php
            }
          
          ?>
        </div>
      </div>
    </div>
    <div class="row my-3">
      <?php
        $category = mysqli_query($conn, "SELECT * FROM category");
      ?>
      <div class="card border-info w-100">
        <div class="card-header bg-info text-white">
          <p class="h3">Categories</p>
        </div>
        <div class="card-body ">
          <?php
            while ($row = mysqli_fetch_assoc($category)) {
                ?>
              <a class="font-weight-bold text-info" href="category.php?category=<?php echo urlencode($row['name']); ?>"><?php echo $row['name']; ?></a><br>
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
        $_SESSION['message'] .= "<li>Enter Answer Content</li>";
      } 


    header("location:fullpost.php?post=". urlencode($post_id));


    }else{


    $query = "INSERT INTO comment (username ,email ,comment , status , post_id , date ) VALUES ('{$name}' , '{$email}' ,'{$comment}' , '{1}' ,{$post_id} , '{$date}')";
    if (!mysqli_query($conn , $query)) {
      $_SESSION['message'] = "error:" . $query . "<br>". mysqli_error($conn);
    header("location:fullpost.php?post=". urlencode($post_id));
    }else {
      $_SESSION['message'] = 'Answer Submit Success';
    header("location:fullpost.php?post=". urlencode($post_id));    }}
  }
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
      $('#createforum').click(function(e){  
    e.preventDefault();
    var name = $('#name1').val();
    var email = $('#email1').val();
    var question = $('#question1').val();
    var category = $('#category1').val();
    var description = $('#description1').val();
    if(name == ''){
      $('.errname').html(
      '<span style="color:red;">Enter name !</span>'
      );
      $('#name1').focus();
      return false;
      }else{
          $('.errname').html("");
        }
    if(email == ''){
      $('.erremail').html(
      '<span style="color:red;">Enter email !</span>'
      );
      $('#email1').focus();
      return false;
    }else{
          $('.erremail').html("");
    }
    if(question == ''){
      $('.errquestion').html(
      '<span style="color:red;">Enter question !</span>'
      );
      $('#question1').focus();
      return false;
    }else{
          $('.errquestion').html("");
    }
    if(category == ''){
      $('.errcategory').html(
      '<span style="color:red;">Enter category !</span>'
      );
      $('#category1').focus();
      return false;
    }else{
          $('.errcategory').html("");
    }
    if(description == ''){
      $('.errdescription').html(
      '<span style="color:red;">Enter description !</span>'
      );
      $('#description1').focus();
      return false;
    }else{
          $('.errdescription').html("");
    }
          $.ajax({
            url : "add-forum.php",
            method:"POST",
            data:{ name:name, email:email,question:question, category:category,description:description},           
              success:function(data){
                $('.message_box').html(data);
                  }
            });
  });

    </script>

<?php include 'includes/layout/footer.php'; ?>