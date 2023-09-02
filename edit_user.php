<?php
	include('dbconnect.php');
	include ("functions.php");
	
	
	$id=$_GET['id'];
	$last = '';
	$first = '';
	$username = '';
	$email = '';
	$pass = '';
	$pwdrepeat = '';
	$errors = array();
	
	
	$res=mysqli_query($conn,"SELECT * FROM signup WHERE id=$id; ");
	while($row=mysqli_fetch_array($res))
	{
		$last=$row['last'];
		$first=$row['first'];
		$email=$row['email'];
		$username=$row['username'];
		$pass=$row['password'];
	}
	

		
	
	
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update form</title>
    <link rel="stylesheet" href="assets/css/edit_user.css">
  </head>
  <body>

<!-- Sign Up Form -->
    <div class="center">
      <form action="edit_user.php?id=<?php echo $id;?>" method="POST">
	<?php echo display_error(); ?>
	  <h1> UPDATE FORM </h1>
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
          <input type="text" name="uid"  value="<?php echo htmlspecialchars($username); ?>"required>
          <span></span>
          <label>Username</label>
        </div>	
        <div class="txt_field">
          <input type="password" name="pwd" value=""required>
          <span></span>
          <label>Password</label>	
        </div>
	<div class="txt_field">
          <input type="password" name="pwdrepeat" value=""required>
          <span></span>
          <label>Repeat Password</label>	
        </div>	
        <input type="submit" value="update" name="update">
      </form>
    </div>

  </body>
   <?php
	
   	if(isset($_POST['update'])){
		
		$last = mysqli_real_escape_string($conn,$_POST['lname']);
		$first = mysqli_real_escape_string($conn,$_POST['fname']);
		$username = mysqli_real_escape_string($conn,$_POST['uid']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$pass = mysqli_real_escape_string($conn,$_POST['pwd']);
		$pwdrepeat = mysqli_real_escape_string($conn,$_POST['pwdrepeat']);
		
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
			$query = "UPDATE signup set last='$last',first='$first',email='$email',username='$username',password='$password' WHERE id=$id; ";
			if(mysqli_query($conn,$query)){
			redirect_to("admin_user.php");
			}else{
				echo 'error in the database';
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
 
</html>

