<?php
	include('..\dbconnect.php');
	include ('..\functions.php');
	session_start();
	


	$uid = $_SESSION['user'];
	
	
	$id=$_GET['id'];
	$art_id=$_GET['art_id'];
	
	
	
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ..\login.php');
}
	
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ..\ProjectArt.php");
}
	


	
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Shipping details</title>
    <link rel="stylesheet" href="css/upload_artwork.css">
  </head>
  <body>

<!-- shipping form -->
    <div class="center">
      <form action="order_summary.php?id=<?php echo $id;?>&art_id=<?php echo $art_id;?>" enctype="multipart/form-data" method="POST">
	  <h1> Shipping Details </h1>
        <div class="txt_field">
          <input type="text" name="streetAdd" value="" required>
          <span></span>
          <label>Street Adress</label>
        </div>
		 <div class="txt_field">
          <input type="text" name="brgy" value="" required>
          <span></span>
          <label>Barangay</label>
        </div>
	<div class="txt_field">
          <input type="text" name="city"  value="" required>
          <span></span>
          <label>City</label>
        </div>
        <div class="">
		  <label>Choose a Courier: </label>	
          <select name="courier" >
		  <option value="Lalamove">Lalamove</option>
		  <option value="Ninja Van">Ninja Van</option>
		  <option value="JRS">JRS</option>

		  </select>
		  
          <span></span>
          
        </div>
		&nbsp;
		&nbsp;
        <input type="submit" value="Next" name="submit" >
      </form>
    </div>

  </body>
   


	


	
 
</html>

