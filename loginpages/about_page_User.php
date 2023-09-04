<?php
	 session_start();
    ob_start();
	include('../dbconnect.php');
	include('../functions.php');
	


	
	$uid = $_SESSION['user'];
	$sql = "SELECT * FROM signup WHERE username = '$uid'; ";
	$first = '';
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$first = $row['first'];
		} 
	}
	
	
	mysqli_free_result($result);
	
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}
	
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../ProjectArt.php");
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>The Art Gallery</title>
	<link href="css/aboutUser.css" rel="stylesheet" type="text/css">
	<link href="../assets/img/tag.ico" rel="icon" type="image/x-icon" >
</head>

<body>
hover on them!
<!-- Header -->
  <div class="wrapper">
		  <div class="logo">
			  <img src="../assets/img/logonew.png" alt="">
		  </div>
	<ul class="nav-area">
	  	  <li><a href="ProjectArtUser.php"> Home </a> </li>
		  <li><a href="about_page_User.php"> About </a> </li>
		  <li><a href="artworksUser.php"> Artwork</a> </li>
		  <li><a href="profile.php"><?php echo $first,' (User)'; ?></a> </li>
		  <li><a href="ProjectArtUser.php?logout='1'">log out</a> </li>
    </ul>
  </div>
<!--body-->
	
	<div class="about">
			<div class="about-img">
				<img src="../assets/img/puplogo.png" alt="Logo of the Polytechnic University of the Philippines">
			</div>
			<div class= "about-text">
				<h1>About us</h1>
				<p>We are a small group from one of the greatest college ever built, The country’s best polytechnic U, we came from one of the most dedicated department, the Department of College of Computer and Information Sciences under the course of Bachelor of Science in Information Technology.

				<br><br>This Website is a project requirement for our subjects of Database Administration and Web Development, it is a test for our skills as designers, coders and critical thinkers, for that we thank our professors that taught us for this requirement and skills to be ready for our careers.
				</p>
			</div>
		</div>
	
</body>
<div class="members">
	<h2> Members:</h2>
	<p>We are the 12th group for our section of BSIT 3-1, the following are our members:</p>
  	<div class= "row">
		<div class="members-col">
			<img src="../assets/img/Carlos.jpg" alt="an image of Carlos Natividad" >
			<h3>-Natividad, Carlos Alfonso A.</h3>
			<p> <em>Leader</em></p>
		  	<p1>Destructive rogue</p1>
		</div>
		<div class="members-col">
			<img src="../assets/img/Arvie.jpg" alt="an image of Rei Cua ">
			<h3>-Cua, Rei Vincent</h3>
			<p> <em>System Developer</em></p>
		  	<p1>world's greatest palladin</p1>
		</div>
		<div class="members-col">
			<img src="../assets/img/Peter.jpg" alt="an image of Peter Yanguas" >
			<h3>-Yanguas, Lawrence Peter</h3>
			<p> <em>System Developer</em></p>
		  	<p1>sexually attractive bard</p1>
		</div>
	</div>
	<p1>Hover your mouse on them!</p1>
</div>
</html>