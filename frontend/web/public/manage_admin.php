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

 <?php
 	 if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 5;
        $offset = ($pageno-1) * $no_of_records_per_page;

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
				if (isset($_SESSION['message'])) {
					message();
				}
			?>
		<?php
			$query = "SELECT * FROM admin";
			$admin = mysqli_query($conn , $query);
		?>
		<div class="row">
			<div class="col-sm-7">
		<p class="h2">Welcome : <?php $_SESSION['login_user']; ?></p>

		<a href="new_admin.php" class="btn btn-primary">+ Create new admin</a>
		</div>
		<div class="col-sm-5 pt-4 pr-2">
		
			<form action="search.php" method="GET">
			<div class="input-group mb-3">
			  <input type="text" name="query" class="form-control" placeholder="Search">
			  <div class="input-group-append">
			    <input type="submit" name="submit" class=" btn btn-success" value="search">
			    
			  </div>
			</div>
    </form>
   
    </div>
    </div>
		<p class="h2">Admins Are:-</p>
		<table class="table table-hover text-center align-middle" >
			<?php $total_pages_sql = "SELECT COUNT(*) FROM admin";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
        $sql = "SELECT * FROM admin LIMIT $offset, $no_of_records_per_page";
        $res_data = mysqli_query($conn,$sql);
        while($admin_set = mysqli_fetch_assoc($res_data)){
            //here goes the data

					echo '<tr >';
					echo "<td class='pt-4'>".$admin_set['username']."</td>";
                    echo "<td class='pt-4'>".$admin_set['email']."</td>";
					echo '
					 <td>  ';
                            ?>
                            <img src="<?php echo $admin_set['image']; ?>" class="img-rounded" width="50" height="50" alt="" />
<?php
             echo '</td>';
					echo "<td>";

					?>
					<a class="btn btn-warning" href="edit_admin.php?admin=<?php echo urlencode($admin_set['id']); ?>">Update</a>
					<a class="btn btn-danger" onclick="return confirm('ARE YOU SURE?');" href="delete_admin.php?admin=<?php echo urlencode($admin_set['id']); ?>" >delete</a>
					<?php
					echo '</td>'; ?>



					<?php

					echo '</tr>';

				}
			?>
		</table>
			<nav>
			<ul class="pagination pull-left pagination-lg">
	<!-- Creating backward Button -->
	<?php
	if(isset($Page))
	{
	       if($Page>1){
		?>
		<li><a href="Blog.php?Page=<?php echo $Page-1; ?>"> &laquo; </a></li>
         <?php        }
	} ?>			
		<?php
	
		$QueryPagination="SELECT COUNT(*) FROM admin";
		$ExecutePagination=mysqli_query($conn ,$QueryPagination);
		$RowPagination=mysqli_fetch_array($ExecutePagination);
		  $TotalPosts=array_shift($RowPagination);
		 // echo $TotalPosts;
		  $PostPagination=$TotalPosts/3;
		  $PostPagination=ceil($PostPagination);
		 // echo $PostPerPage;
		
		for($i=1;$i<=$PostPagination;$i++){
	if(isset($Page)){
		if($i==$Page){
		?>
		<li class="active"><a href="manage_content.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
		<?php
		}else{ ?>
		<li><a href="manage_admin.php?Page=<?php echo $i; ?>"><?php echo $i; ?></a></li>	
		<?php
		}
	}
		} ?>
		<!-- Creating Forward Button -->
		<?php
	if(isset($Page))
	{
	       if($Page+1<=$PostPagination){
		?>
		<li><a href="manage_admin.php?Page=<?php echo $Page+1; ?>"> &raquo; </a></li>
         <?php        }
	} ?>	
		</ul>
		</nav>
		 <ul class="pagination justify-content-center mt-5">
        <li><a href="?pageno=1" class="btn btn-primary mx-1">First</a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo '?pageno='.($pageno - 1); } ?>" class="btn btn-primary mx-1">Prev</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo '?pageno='.($pageno + 1); } ?>" class="btn btn-primary mx-1">Next</a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>" class="btn btn-primary mx-1">Last</a></li>
    </ul>

	</div>

</div>

<?php
	include '../includes/layout/footer.php';
?>