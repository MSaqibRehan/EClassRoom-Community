<?php
    include '../includes/layout/index_header.php';
    include '../includes/config.php';
    include '../includes/sessions.php';
?>

<div class="row" style="min-height: 500px">
    <div class="col-3 sidebar bg-info py-3">
    <form action="content_search.php" method="GET">
            <div class="input-group mb-3">
              <input type="text" name="query" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <input type="submit" name="submit" class=" btn btn-success" value="search">
                
              </div>
            </div>
    </form>
<?php 
    $subject_query = "SELECT * FROM subjects";
    $subject = mysqli_query($conn , $subject_query);

    echo "<ul class='list-unstyled pl-3'>";

    while ($subject_set = mysqli_fetch_assoc($subject)) {
        $subject_id = mysqli_real_escape_string($conn , $subject_set['id']);
            echo '<li>';
        ?>
        
        <a class="text-dark <?php if ($subject_set['id'] == $safe_selected_subject) {
                                        echo ('font-weight-bold font-italic');
                                    }  ?>" style="font-size: 18px;" href="index.php?subject=<?php echo urlencode($subject_id); ?>"> <i class="fas fa-list-ul fa-1x pr-2"></i><?php echo htmlentities($subject_set['subject_name']); ?></a>
        
        <?php
        if (isset($safe_selected_page)) {
            $record = mysqli_query($conn , "SELECT * FROM pages WHERE id={$safe_selected_page}");
            $record_set = mysqli_fetch_assoc($record);
        }
        global $record_set;
if ( isset($safe_selected_subject) == $subject_id && $safe_selected_subject == $subject_id || $record_set['subject_id'] == $subject_id) {
            
                $page_query = "SELECT * FROM pages WHERE subject_id = $subject_id ";
                    
            $page = mysqli_query($conn , $page_query);
            
            while ($page_set = mysqli_fetch_assoc($page)) {
                $page_id = mysqli_real_escape_string($conn , $page_set['id']);
                echo "<ul class='list-unstyled pl-3'>";
                echo '<li>';
        ?>
        
        <a class='text-dark <?php if($safe_selected_page == $page_set["id"]){ echo "font-weight-bold font-italic";} ?>' style="font-size: 18px;" href="index.php?page=<?php echo urlencode($page_id); ?>"><i class="fas fa-angle-double-right fa-xs pr-2"></i> <?php echo htmlentities($page_set['page_name']); ?></a>
        
        <?php
         echo "</li>";  
              echo '</ul>';
             
            }
            
}

    }
    echo "</li>";
    echo "</ul>";
    ?>



</div>
    <div class="col-9 bg-light mx-auto py-3" >
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
        // 
         $raw_results_pages = mysqli_query($conn , "SELECT * FROM pages
            WHERE (`page_name` LIKE '%".$query."%') ") or die(mysqli_error($conn));
        $raw_results = mysqli_query($conn , "SELECT * FROM subjects
            WHERE (`subject_name` LIKE '%".$query."%') ") or die(mysqli_error($conn));

        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
echo "<h2>Search Records For keyword : ".$query."</h2>";
        if(mysqli_num_rows($raw_results) > 0 || mysqli_num_rows($raw_results_pages) > 0 ){ // if one or more rows are returned do following
echo "<p class='h3'>Subjeccts are :- </p>";
                echo "<ul>";
            while ($subject_set = mysqli_fetch_assoc($raw_results)) {
                $subject_id = mysqli_real_escape_string($conn , $subject_set['id']);
                echo "<li> ";

                ?>
                <a class="text-dark" href="index.php?subject=<?php echo urlencode($subject_set['id']); ?>"><?php echo $subject_set['subject_name'] ;?></a>

                <?php
                echo "</li>";

            }
            echo "</ul>" ;
            echo "<p class='h3'>pages are :- </p>";

                echo "<ul>";
            while ($page_set = mysqli_fetch_assoc($raw_results_pages)) {
                $page_id = mysqli_real_escape_string($conn , $page_set['id']);
                echo "<li> ";

                ?>
                <a class="text-dark" href="index.php?page=<?php echo urlencode($page_id) ?>"><?php echo $page_set['page_name'] ;?></a>

                <?php
                echo "</li>";

            }
            echo "</ul>";
     


                          // posts results gotten from database(title and text) you can also show id ($results['id'])
            

        }
        else{ // if there is no matching rows do following
            echo "No results";
        }

    
    }else{ // if query length is less than minimum
        echo "Minimum length is ".$min_length;
    }
?>
    </div>

</div>

<?php
    include '../includes/layout/footer.php';
?>