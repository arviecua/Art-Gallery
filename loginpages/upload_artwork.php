<?php
    session_start();
    ob_start();
	include('../dbconnect.php');
	include('../functions.php');
	
	$id=$_GET['id'];
	
	$art_title ='';
	$art_desc ='';
	$art_price ='';
	$art_date ='';
	$art_category ='';
	
	 	
   	if(isset($_POST['submit'])){
		
		$tmp_file = $_FILES['art_imagepath']['tmp_name'];
		$target_file = basename($_FILES['art_imagepath']['name']);
        $upload_dir = "../assets/img";
	    move_uploaded_file($tmp_file, $upload_dir."/".$target_file);
		
		
		
		$art_title = mysqli_real_escape_string($conn,$_POST['art_title']);
		$art_desc = mysqli_real_escape_string($conn,$_POST['art_desc']);
		$art_price = mysqli_real_escape_string($conn,$_POST['art_price']);
		$art_date = mysqli_real_escape_string($conn,$_POST['art_date']);
		$art_category = mysqli_real_escape_string($conn,$_POST['art_category']);
		
		// trigger will activate and will also insert the details to history table for recent posts
		$query = "INSERT INTO artwork( id, art_title, art_desc, art_price, art_date, art_category, art_status, art_imagepath) 
          VALUES( '$id', '$art_title', '$art_desc', '$art_price', '$art_date', '$art_category', 'available', '$target_file')";
          
		if(mysqli_query($conn,$query)){
			redirect_to("profile.php");
			
			}else{
				echo 'error in the database';
			}
		
		
	}
	
	
	

		
	
	
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Artwork</title>
    <link rel="stylesheet" href="css/upload_artwork.css">
  </head>
  <body>

<!-- Sign Up Form -->
    <div class="center">
      <form action="upload_artwork.php?id=<?php echo $id;?>" enctype="multipart/form-data" method="POST">
	  <h1> Upload Artwork </h1>
        <div class="txt_field">
          <input type="text" name="art_title" value="" required>
          <span></span>
          <label>Art Title</label>
        </div>
	<div class="txt_field">
          <input type="textarea" name="art_desc" rows="4" cols="50" value="" required>
          <span></span>
          <label>Art Description</label>
        </div>
        <div class="txt_field">
          <input type="number" name="art_price"  value=""required>
          <span></span>
          <label>Art Price</label>
        </div>
        <div class="txt_field">
		  <label></label>
          <input type="date" name="art_date"  value=""required>
          <span></span>
          
        </div>	
        <div class="">
		  <label>Choose a Category: </label>	
          <select name="art_category" >
		  <option value="Minimalism">Minimalism</option>
		  <option value="Expressionism">Expressionism</option>
		  <option value="Realism">Realism</option>
		  <option value="Abstract">Abstract</option>

		  </select>
		  
          <span></span>
          
        </div>
	<div class="txt_field">
		  <label>Artwork Image: </label>
          <input type="file" name="art_imagepath"  required>
          <span></span>
          
        </div>
        <input type="submit" value="Upload" name="submit" >
      </form>
    </div>

  </body>
   


	


	
 
</html>

