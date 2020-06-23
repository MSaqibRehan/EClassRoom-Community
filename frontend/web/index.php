

<?php
	include 'includes/config.php';
	include 'includes/sessions.php';
	
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/jpg" href="images/icon.png">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
        nav a{
            color: grey;
            font-size: 20px;
        }
        #dex{
             padding-top: 10px;
            }
        #dex a:hover{
            color: white !important;
            font-weight: normal !important;
            background: #033B6A;
            text-decoration: none;
            padding: 5px;
            border-radius: 5px;
        }
        .sidebar a{
            font-size: 18px;
        }
        .sidebar a:hover{
            background-color: dodgerblue;
            border-radius: 5px;

        }
        .sidebar a.active{
            background-color: dodgerblue;
            border-radius: 5px;
        }

    </style>
</head>
<body class=" m-0 p-0">
<div class="container-fluid m-0 p-0" style="padding: 0px;">
        <div class="row my-0">
            <div class="col-12 p-0">
                    <nav class="navbar navbar-expand-lg bg-dark py-0 pr-3" style="border-top: 5px solid #36B0DD; border-bottom: 5px solid #36B0DD;">

                <a href="" class=" offset-1 navbar-brand js-scroll-trigger font-weight-bold p-1" style="color: #36B0DD; font-size: 25px; font-style: italic;"> eClassroom & Community</a>
                <button class="navbar-toggler navbar-toggler-right text-uppercase bg-success text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav nav-pills w-100 ">
                        
                        

           <form action="search.php" method="GET" class="my-auto  ml-auto mr-5">
            <div class="input-group">
              <input type="text" name="query" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <input type="submit" name="submit" class=" btn btn-success" value="search">
                
              </div>
            </div>
    </form>
                    </ul>
                </div>
            </nav>
        </div>
            </div>

 <?php
	 if (isset($_GET['pageno'])) {
						$pageno = $_GET['pageno'];
				} else {
						$pageno = 1;
				}
				$no_of_records_per_page = 10;
				$offset = ($pageno-1) * $no_of_records_per_page;

	?>
<div class="row" style="min-height: 520px;">
	<div class="col-md-9 pl-5">
<div style="width: 85%;" class="row   my-3 mx-auto ">
		<p class="h2 text-capitalize text-info">Check Out the Recent Forums</p>
		<?php

			$total_pages_sql = "SELECT * FROM posts";
				$result = mysqli_query($conn,$total_pages_sql);

				$total_rows = mysqli_num_rows($result);
				$total_pages = ceil($total_rows / $no_of_records_per_page);

			$record = mysqli_query($conn , "SELECT * FROM posts LIMIT $offset , $no_of_records_per_page");
			while ($record_set = mysqli_fetch_assoc($record)) {
				$comment = mysqli_query($conn , "SELECT * FROM comment WHERE status = 1 AND post_id = {$record_set['id']}");
				$comment_count = mysqli_num_rows($comment);
				?>
				<div class='row my-2  w-100 m-0 p-3' style="background: 	#E6E6FA;">
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
				<?php 
				if ($pageno >1) {
					?>
				<a href="?pageno=<?php echo urlencode($pageno-1); ?>" class="btn btn-light border-info "><i class="fas fa-angle-double-left"></i></a>
					<?php
				}
					for ($i=1 ; $i<=$total_pages;$i++) {
					    ?>
					<a href="?pageno=<?php echo urlencode($i); ?>"  class="btn btn-light border-info  <?php if($i == $pageno){
						echo 'bg-info text-white';
					} ?>"><?php echo $i; ?></a>
					    <?php
					}
					if ($pageno <$total_pages) {
					?>
				<a href="?pageno=<?php echo urlencode($pageno+1); ?>" class="btn btn-light border-info "><i class="fas fa-angle-double-right"></i></a>
					<?php
				}
				?>
 

		



</div>
	</div>
	<div class="col-md-2 justify-content-start my-5">
		<div class="row my-2">
			<div class="col-12 px-0">
				<a href="" title="Add New Forum" class="btn btn-primary btn-block font-weight-bold btn-lg">Add New Forum</a>
			</div>
		</div>
		
		
		<div class="row">
			<?php
				$post = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC LIMIT 10");
			?>
			<div class="card border-info w-100">
				<div class="card-header bg-info text-white">
					<p class="h3">Rescent Posts</p>
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

<?php include 'includes/layout/footer.php'; ?>