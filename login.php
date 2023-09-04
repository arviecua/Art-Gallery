<?php
	include('dbconnect.php');
	session_start();
	
	$uid = '';
	$pass = '';

	if(isset($_POST['submit'])){
		
		$uid = mysqli_real_escape_string($conn,$_POST['uid']);
		$pass = mysqli_real_escape_string($conn,$_POST['pass']);
		
		// SELECT * from signup WHERE username = '$uid'
		
		// $sql = "call getusername_info('$uid');";
		$sql = "SELECT * from signup WHERE username = '$uid'";
		
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_array($result)){
				if(password_verify($pass,$row["password"]) && $row['user_type'] == 'admin'){
					$_SESSION['user']= $uid;
					$_SESSION['user_type']= $row['user_type'];
					header("location: admin.php");
				}
				else if(password_verify($pass,$row["password"]) && $row['user_type'] == 'user'){
					$_SESSION['user']= $uid;
					
					header("location: loginpages/ProjectArtUser.php");
				}
				else{
					echo '<script> alert("Wrong password!") </script>';
				}
					
						
				
			}
		}
		else
		{
			echo '<script> alert("No Account Found") </script>';
		}
	}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
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
<!-- Login Form -->
    <div class="center">
      <h1>Sign In</h1>
      <form method="post">
        <div class="txt_field">
          <input type="text" name="uid" value = "<?php echo htmlspecialchars($uid); ?>" required>
          <span></span>
          <label>Username</label>
        </div>
        <div class="txt_field">
          <input type="password" name="pass" value = "<?php echo htmlspecialchars($pass); ?>" required>
          <span></span>
          <label>Password</label>
        </div>
        <input type="submit" name="submit" value="Login">
        <div class="signup_link">
          Not a member? <a href="signup.php">Signup</a>
        </div>
      </form>
    </div>

  </body>
</html>
