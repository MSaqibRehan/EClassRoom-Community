<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
  include 'includes/layout/index_header.php';
?>
<?php 
  if (isset($_GET['category'])) {
    $selected_category = mysqli_real_escape_string($conn , $_GET['category']);
  }
?>
<div class="row" style="min-height: 520px;">
  <div class="col-md-9 pl-5">
<div class="row w-75  my-3 mx-auto ">
    <p class="h3">Category: <?= $selected_category ?></p>
    <?php
      $record = mysqli_query($conn , "SELECT * FROM posts WHERE category = '{$selected_category}'");
      while ($record_set = mysqli_fetch_assoc($record)) {
        $string = substr($record_set['content'], 0, 200);
        $comment = mysqli_query($conn , "SELECT * FROM comment WHERE status = 1 AND post_id = {$record_set['id']}");
        $comment_count = mysqli_num_rows($comment);
        ?>
        <div class='row my-2  w-100 m-0 p-3' style="background:   #E6E6FA;">
          <div class="col-12 " >
          
          <div class="row ">
            <p class="h2 text-info font-italic text-underline">
              <u><?php echo $record_set['title']; ?></u>
            </p>
          </div><br>
          <div class="row w-100">
            <p class="text-secondary font-weight-bold w-100">Category : <?php echo $record_set['category']; ?> Published On : <?php echo $record_set['date']; ?> <span class="float-right badge badge-secondary text-right">Answers:<?php echo $comment_count; ?></span></p>
          </div>
          
          <div class="row">
            <a href="fullpost.php?post=<?php echo urlencode($record_set['id']); ?>" class="btn btn-info ml-auto">View Answers</a>
          </div>
        
</div>
        </div>
        <hr>

        <?php
      }
        ?>




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
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Your Name"> 
            
          </div>
      <span class="errname"></span>
          <div class="form-group">
            <label class="form-control-label">Your Email</label> 
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email Address"> 
            <span class="erremail"></span>
          </div>
          <div class="form-group">
            <label class="form-control-label">Your Question</label> 
            <input type="text" class="form-control" id="question" name="question"> 
            <span class="errquestion"></span>
          </div>
          <div class="form-group">
            <label class="form-control-label">Category</label> 
            <input type="text" class="form-control" id="category" name="category"> 
            <span class="errcategory"></span>
          </div>
          <div class="form-group">
            <label class="form-control-label">Description</label> 
            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Please Describe Your Question"></textarea>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
      $('#createforum').click(function(e){  
    e.preventDefault();
    var name = $('#name').val();
    var email = $('#email').val();
    var question = $('#question').val();
    var category = $('#category').val();
    var description = $('#description').val();
    if(name == ''){
      $('.errname').html(
      '<span style="color:red;">Enter name !</span>'
      );
      $('#name').focus();
      return false;
      }else{
          $('.errname').html("");
        }
    if(email == ''){
      $('.erremail').html(
      '<span style="color:red;">Enter email !</span>'
      );
      $('#email').focus();
      return false;
    }else{
          $('.erremail').html("");
    }
    if(question == ''){
      $('.errquestion').html(
      '<span style="color:red;">Enter question !</span>'
      );
      $('#question').focus();
      return false;
    }else{
          $('.errquestion').html("");
    }
    if(category == ''){
      $('.errcategory').html(
      '<span style="color:red;">Enter category !</span>'
      );
      $('#category').focus();
      return false;
    }else{
          $('.errcategory').html("");
    }
    if(description == ''){
      $('.errdescription').html(
      '<span style="color:red;">Enter description !</span>'
      );
      $('#description').focus();
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