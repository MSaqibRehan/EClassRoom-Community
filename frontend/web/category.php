<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
	include 'includes/layout/header.php';
?>
<?php 
  if (isset($_GET['category'])) {
    $selected_category = mysqli_real_escape_string($conn , $_GET['category']);
  }
?>
<div class="row" style="min-height: 520px;">
  <div class="col-md-9 pl-5">
<div class="row w-75  my-3 mx-auto ">
    <p class="h3">MY PHP RESPONSIVE BLOG</p>
    <?php
      $record = mysqli_query($conn , "SELECT * FROM posts WHERE category = '{$selected_category}'");
      while ($record_set = mysqli_fetch_assoc($record)) {
        $string = substr($record_set['content'], 0, 200);
        $comment = mysqli_query($conn , "SELECT * FROM comment WHERE status = 1 AND post_id = {$record_set['id']}");
        $comment_count = mysqli_num_rows($comment);
        ?>
        <div class='row my-2 bg-light w-100 m-0 p-2'>
          <div class="col-12">
          <div class="row">
            <img src="<?php echo $record_set['image'] ?>" height="300" class='w-100'">
          </div><br>
          <div class="row h1 text-primary font-italic">
            <?php echo $record_set['title']; ?>
          </div><br>
          <div class="row w-100">
            <p class="text-secondary font-weight-bold w-100">Category : <?php echo $record_set['category']; ?> Published On : <?php echo $record_set['date']; ?> <span class="float-right badge badge-secondary text-right">Comments:<?php echo $comment_count; ?></span></p>
          </div>
          <div class="row w-100">
            <p><?php echo $string; ?></p>
          </div>
          <div class="row w-100 justify-content-end">
            <a href="fullpost.php?post=<?php echo urlencode($record_set['id']); ?>" class="btn btn-primary ">Read More</a>
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
    <div class="row my-3">
      <p class="h2">About Me</p>
      <img src="images/rehan.jpg" class="rounded-circle img-fluid" style="height: 180px !important;"  alt="">
      <p class="text-justify">I am Muhammad Saqib Rehan studying BS computer Science at Islamia University of BAHAWALPUR (subcampus Rahim Yar Khan). I have completed four semesters and secured CGPA of 3.81 so far till now . Besides BSCS I am working as a Web Developer at DEXDEVS.</p>
    </div>
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

<?php include 'includes/layout/footer.php'; ?>