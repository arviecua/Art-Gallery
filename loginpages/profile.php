<?php
    session_start();
    ob_start();
	include('../dbconnect.php');
	include('../functions.php');
	


	
	$uid = $_SESSION['user'];
	
	$sql = "SELECT * FROM signup WHERE username = '$uid'; ";
	
	$first = '';
	$last = '';
	$date = '';
	$id = '';
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$id = $row['id'];
			$first = $row['first'];
			$last = $row['last'];
			$date = $row['date_join'];
			
			
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
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Page Title</title>
        <link rel="stylesheet" href="css/profile.css">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    </head>
    <body>
    <!-- Header -->

    <div class="wrapper">
      <ul class="nav-area">
        <li><a href="ProjectArtUser.php"> Home </a> </li>
        <li><a href="about_page_user.php"> About </a> </li>
        <li><a href="artworksUser.php"> Artwork</a> </li>
        <li><a href="profile.php"><?php echo $first,' (User)'; ?></a> </li>
		<li><a href="ProjectArtUser.php?logout='1'">log out</a> </li>
      </ul>
    </div>

    <!-- Student Profile -->
    <div class="student-profile py-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent text-center">
                            <img class="profile_img" src="../assets/img/user.png" alt="student dp">
                            <h3><?php echo $first,' ',$last; ?></h3>
                        </div>
            <div class="card-body">
              <p class="mb-0"><strong class="pr-1">User ID:</strong><?php echo $id; ?></p>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-header bg-transparent border-0">
              <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
            </div>
            <div class="card-body pt-0">
              <table class="table table-bordered">
                <tr>
                  <th width="30%">Date Joined</th>
                  <td width="2%">:</td>
                  <td><?php echo $date; ?></td>
                </tr>
                <tr>
                  <th width="30%">Total Number of Posts	</th>
                  <td width="2%">:</td>
				  <?php
						$select_count = "SELECT count(*) as 'count' 
										 FROM artwork
										 WHERE artwork.id = $id";
						$post_count = mysqli_query($conn,$select_count);
						while($rows = mysqli_fetch_array($post_count))
						{
						?> 
							<td><?php echo $rows['count']; ?></td>
							
						
						<?php
						} 
						?>		
                  
                </tr>
              </table>
              <div class="btn btn1"><a href="edit_user_User.php?id=<?php echo $id; ?>">Edit Info  </a></div>
			  <div class="btn btn1"><a href="myartworks.php">My artworks</a></div>
			  <div class="btn btn1"><a href="upload_artwork.php?id=<?php echo $id; ?>">Upload Artwork</a></div>
			  <div class="btn btn1"><a href="myorders.php">My Orders</a></div>
            </div>
          </div>
            <div style="height: 26px"></div>
        </div>
      </div>
    </div>
  </div>
    </body>
</html>
