<?php
  include 'includes/config.php';
  include 'includes/sessions.php';
?>
<?php 
	$name= mysqli_real_escape_string($conn,$_POST['name']);
	$email= mysqli_real_escape_string($conn,$_POST['email']);
	$question= mysqli_real_escape_string($conn,$_POST['question']);
	$category= mysqli_real_escape_string($conn,$_POST['category']);
	$description= mysqli_real_escape_string($conn,$_POST['description']);
	
	date_default_timezone_set("Asia/Karachi");
	 $date =  date("Y-m-d H:i:s");
	  $author = $name;

	 $category_query=mysqli_query($conn, "SELECT * FROM category WHERE name = '$category'");
	$cat_count=mysqli_num_rows($category_query);
	if (!$category_query || $cat_count == 0) {
		$cat_query="INSERT INTO category (date , name , creator) VALUES('{$date}' , '{$category}' , '{$author}')";
		if (mysqli_query($conn, $cat_query)) {
		  $cat_id = mysqli_insert_id($conn);
		}
	}else{
		$cat_rec=mysqli_fetch_assoc($category_query);
		$cat_id=$cat_rec['name'];
	}
	if (!empty($name) || !empty($email) || !empty($question) || !empty($category) || !empty($description)) {
		$query = "INSERT INTO posts (date ,title,category,author,content,author_email) VALUES('{$date}' , '{$question}' , '{$category}' , '{$author}'  , '{$description}', '{$email}')";
     	if (mysqli_query($conn , $query)) {
        echo "<p class='font-weight-bold text-success'>New Forum Added</p>";
       
	    }else{
	        echo "<p class='font-weight-bold text-danger'>New Forum Added</p>";
	    }
	}
 ?>