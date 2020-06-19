<?php 
	session_start();

	function message(){
		?>
		<div class="alert alert-success alert-dismissible fade show" role="alert">
  <ul> <?php   echo $_SESSION['message']; ?></ul>
  <button type="button" class="close w-25 h-100" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
	
    

    <?php           
		
$_SESSION['message'] = null;
	
	}
	
?>


