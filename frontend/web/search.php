<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
    include 'includes/layout/index_header.php';
?>

<div class="row" style="min-height: 500px">
        <div class="col-9 bg-light mx-auto py-3 " >
<?php
    $query = $_GET['query'];
    // gets value sent over search form

    $min_length = 3;
    // you can set minimum length of the query if you want

    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then

        $query = htmlspecialchars($query);
        // changes characters used in html to their equivalents, for example: < to &gt;

        $query = mysqli_real_escape_string($conn , $query);
        // makes sure nobody uses SQL injection

        $raw_results = mysqli_query($conn , "SELECT * FROM posts
            WHERE (`title` LIKE '%".$query."%') ") or die(mysqli_error($conn));

        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
echo "<h2>Search Records For keyword : <span class='text-success'>".$query."</span></h2>";
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
            echo "<div style='width:85%;' class='row mx-auto my-2'>";
     while ($record_set = mysqli_fetch_assoc($raw_results)) {
        $string = substr($record_set['content'], 0, 200);
        $comment = mysqli_query($conn , "SELECT * FROM comment WHERE status = 1 AND post_id = {$record_set['id']}");
        $comment_count = mysqli_num_rows($comment);
        ?>
        <div class='row my-2 m-0 p-2 p-3' style="background: #DCDCDC; ">
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
      echo "</div>";  
            

        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

    
    }else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
    </div>



    <div class="col-2 justify-content-start my-5">
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
  <div class="col-1"></div>

</div>


   <?php include 'includes/layout/footer.php'; ?>
