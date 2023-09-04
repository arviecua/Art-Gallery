<?php	
	include('dbconnect.php');
	include('functions.php');
	

	session_start();
	


	
	$uid = $_SESSION['user'];
	$usertype = $_SESSION['user_type'];
	$sql = "SELECT * FROM signup WHERE username = '$uid'; ";
	$first = '';
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$first = $row['first'];
		} 
	}
	
	
	mysqli_free_result($result);
	
	if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}
	
if (isset($_GET['user'])) {
		header("location: admin_user.php");
}
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ProjectArt.php");
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Admin</title>
        <!-- Boxicons Css -->
        <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="assets/css/adminnew.css">
    </head>
    <body>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo-details">
                <i class='bx bxs-landmark' ></i>
                <span class="logo_name">Art Gallery</span>
            </div>
            <ul class="nav-links">
                <li>
                    <a href="admin.php">
                        <i class='bx bx-grid-alt' ></i>
                        <span class="links_name">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="admin_user.php">
                        <i class='bx bxs-user-detail' ></i>
                        <span class="links_name">Users</span>
                    </a>
                </li>
                <li class="logout">
                    <a href="admin.php?logout='1'">
                        <i class='bx bx-log-out' ></i>
                        <span class="links_name" >Log Out</span>
                    <a>
                </li>
            </ul>
        </div>

        <!-- Home Content -->
        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class='bx bx-menu sidebarBtn' ></i>
                    <span class="dashboard">Dashboard</span>
                </div>
                <div class="search-box">
                    <input type="text" placeholder="Search Here...">
                    <i class='bx bx-search' ></i>
                </div>
                <div class="profile-details">
                    <img src="assets/img/<?php echo $first; ?>.jpg" alt="">
                    <span class="admin_name">><?php echo $first; ?></span>
                    <i class='bx bxs-down-arrow'></i>
                </div>
            </nav>

            <!-- Home Content -->
            <div class="home-content">
                <div class="overview-boxes">
                    <div class="box">
                        <div class="left-side">
                            <div class="box_topic">No. of Users</div>
                            <div class="number">
							<?php
							$select_count = "SELECT count(*) as 'count' FROM signup WHERE user_type = 'user';";
							$user_count = mysqli_query($conn,$select_count);
							while($rows = mysqli_fetch_array($user_count))
							{
							?> 
								<p><?php echo $rows['count']; ?></p>
						
							<?php
							} 
							?>		
							
                        
                        </div>
                        </div>
						<i class='bx bxs-user-account user'></i>
                    </div>
                </div>	
				
            </div>
					<!-- User Posts -->
              <form id="form1" name="form1" method="post">
              <table class="table" >
			  <h1> RECENT POSTS </h1>
                <thead>
                
				<tr>
					<th width="220">Date Posted</th>
                    <th width="194">User ID</th>
					<th width="194">First Name</th>
					<th width="194">Last Name</th>
					<th width="194">ART ID</th>
					<th width="194">ART title</th>
					
                 
                  </tr>
				</thead>
				<tbody>
				<?php
					$sql = " SELECT history.date, history.id, history.art_id, history.art_title, signup.first, signup.last from 
							 history, signup
							 WHERE history.id = signup.id;";
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result))
					{
						?>
						 <tr>
							 <td ><?php echo $row['date']; ?></td>
                   			 <td ><?php echo $row['id']; ?></td>
							 <td ><?php echo $row['first']; ?></td>
							 <td ><?php echo $row['last']; ?></td>
                    		 <td ><?php echo $row['art_id']; ?></td>
                   			 <td ><?php echo $row['art_title']; ?></td>
 
                  		</tr>
						
						<?php
						
					}
					?>
					
				
				
				
                 
					
					
					
                </tbody>
              </table>
			  <p>&nbsp;</p>
              <p>&nbsp;</p>
            </form>

        </section>

        <!-- <script src="assets/js/script.js"></script> -->

    </body>
</html>