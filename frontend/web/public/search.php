<?php
    include '../includes/layout/header.php';
    include '../includes/config.php';
    include '../includes/sessions.php';
?>
<?php
    if(!isset($_SESSION["login_user"])){
        header("Location:login.php");
    }
 ?>
<div class="row" style="min-height: 500px">
    <div class="col-3 sidebar bg-info py-3">
        <div class="w-100 mx-auto">
            <p class="h4 ">Content Management</p>
            <a href="manage_content.php" class="btn btn-lg btn-primary w-100">Manage Content</a>
            <a href="manage_admin.php" class="btn btn-lg btn-primary w-100 my-3">Manage admins</a>
            <a href="logout.php" class="btn btn-lg btn-danger w-100">LOGOUT</a>
        </div>
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

        $raw_results = mysqli_query($conn , "SELECT * FROM admin
            WHERE (`username` LIKE '%".$query."%') ") or die(mysqli_error($conn));

        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table

        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
echo "<h2>Search Records For keyword : ".$query."</h2>";
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
echo "<table class='table table-striped'>";
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop


                    echo '<tr >';
                    echo "<td class='pt-4'>".$results['username']."</td>";
                    echo "<td class='pt-4'>".$results['email']."</td>";
                    echo '
                     <td>  ';
                            ?>
                            <img src="<?php echo $results['image']; ?>" class="img-rounded" width="50" height="50" alt="" />
<?php
             echo '</td>';
                    echo "<td>";

                    ?>
                    <a class="btn btn-warning" href="edit_admin.php?admin=<?php echo urlencode($results['id']); ?>">Update</a>
                    <a class="btn btn-danger" onclick="return confirm('ARE YOU SURE?');" href="delete_admin.php?admin=<?php echo urlencode($results['id']); ?>" >delete</a>
                    <?php
                    echo '</td>'; ?>



                    <?php

                    echo '</tr>';

                }     
                echo "</table>";           // posts results gotten from database(title and text) you can also show id ($results['id'])
            

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