<?php
	include('dbconnect.php');
	
	$last = '';
	$first = '';
	$username = '';
	$email = '';
	$pass = '';
	$pwdrepeat = '';
	$contact = '';
	$errors = array();
	
	if(isset($_POST['submit'])){
		$last = mysqli_real_escape_string($conn,$_POST['lname']);
		$first = mysqli_real_escape_string($conn,$_POST['fname']);
		$contact = mysqli_real_escape_string($conn,$_POST['contact']);
		$username = mysqli_real_escape_string($conn,$_POST['uid']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$pass = mysqli_real_escape_string($conn,$_POST['pwd']);
		$pwdrepeat = mysqli_real_escape_string($conn,$_POST['pwdrepeat']);
		
		
	$user_check = mysqli_query($conn, "SELECT * FROM signup WHERE username= '$username'; ") or die("Failed to query database ".mysqli_error($conn));
	$check = mysqli_fetch_row($user_check);
	if ($check>0) {
  echo "<script type=\"text/javascript\">window.alert('Username Already Exists!');window.location.href = 'signup.php';</script>";
}
else{
		
	if (empty($last)) { 
		array_push($errors, "Last Name is required"); 
	}
	if (empty($first)) { 
		array_push($errors, "First Name is required"); 
	}	
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($pass)) { 
		array_push($errors, "Password is required"); 
	}
	if ($pass != $pwdrepeat) {
		array_push($errors, "The two passwords do not match");
	}
	
	if (count($errors) == 0) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			/*INSERT INTO signup(first, last, email,contact, username, password, user_type, date_join) 
			 VALUES('$first','$last','$email','$contact','$username','$password','user',now()) */
			
			$query = "call insert_details('$first','$last','$email',$contact,'$username','$password','user',now());";
			
			if(mysqli_query($conn,$query)){
			echo '<script> alert("saved") </script>';
			}else{
				echo 'error in the database';
			}
	
		
	}
}
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/css/signup.css">
  </head>
  <body>
<!-- Header -->
	<div class="wrapper">
	  <ul class="nav-area">
	  	  <li><a href="ProjectArt.php"> Home </a> </li>
		  <li><a href="about_page.html"> About </a> </li>
		  <li><a href="artworks.php"> Artwork</a> </li>
		  <li><a href="login.php"> Login </a> </li>
	  </ul>
    </div>
<!-- Sign Up Form -->
    <div class="center">
      <h1>Sign Up</h1>
      <form action="signup.php" method="POST">
		<?php echo display_error(); ?>
	  
        <div class="txt_field">
          <input type="text" name="lname" value="<?php echo htmlspecialchars($last); ?>" required>
          <span></span>
          <label>Last Name</label>
        </div>
		<div class="txt_field">
          <input type="text" name="fname" value="<?php echo htmlspecialchars($first); ?>" required>
          <span></span>
          <label>First Name</label>
        </div>
        <div class="txt_field">
          <input type="text" name="email"  value="<?php echo htmlspecialchars($email); ?>"required>
          <span></span>
          <label>Email</label>
        </div>
		<div class="txt_field">
          <input type="text" name="contact"  value="<?php echo htmlspecialchars($contact); ?>"required>
          <span></span>
          <label>Contact Number</label>
        </div>
        <div class="txt_field">
          <input type="text" name="uid"  value="<?php echo htmlspecialchars($username); ?>"required>
          <span></span>
          <label>Username</label>
        </div>	
        <div class="txt_field">
          <input type="password" name="pwd" value="<?php echo htmlspecialchars($pass); ?>"required>
          <span></span>
          <label>Password</label>	
        </div>
	<div class="txt_field">
          <input type="password" name="pwdrepeat" value="<?php echo htmlspecialchars($pwdrepeat); ?>"required>
          <span></span>
          <label>Repeat Password</label>	
        </div>	
        <input type="submit" value="Sign Up" name="submit">
      </form>
    </div>

  </body>
</html>

