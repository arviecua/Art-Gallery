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
        <title>My Orders</title>
        <link rel="stylesheet" href="css/myorders.css">
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
	&nbsp;
	&nbsp;
	&nbsp;
	<h1 style="text-align: center;"> My Orders </h1>
	
	 <table class="table" >
                <thead>
                
				<tr>
					<th width="220">Order ID</th>
                    <th width="194">Order Date</th>
                    <th width="220" >Art ID</th>
					<th width="220">Artist ID</th>
					<th width="220">User ID</th>
					<th width="220">Shipping Address</th>
					<th width="220">Courier</th>
					<th width="220">Art Price</th>
      
                  </tr>
				</thead>
				<tbody>
				<?php
					// SELECT * from order_t where id = $id; call getuserID_orders($id);
					
					$sql = "SELECT * from order_t where id = $id;";
					
					$result = mysqli_query($conn,$sql);
					while($row = mysqli_fetch_array($result))
					{
						?>
						 <tr>
							 <td ><?php echo $row['order_id']; ?></td>
                   			 <td ><?php echo $row['order_date']; ?></td>
                    		 <td ><?php echo $row['art_id']; ?></td>
							 <td ><?php echo $row['artist_id']; ?></td>
                   			 <td ><?php echo $row['id']; ?></td>
							 <td ><?php echo $row['shipping_street'],', ',$row['shipping_brgy'],', ',$row['shipping_city']; ?></td>
							 <td ><?php echo $row['courier']; ?></td>
							 <td ><?php echo $row['art_price']; ?></td>

                  		</tr>
						
						<?php
						
					}
					?>
					
				
				
				
                 
					
					
					
                </tbody>
              </table>

    
    </body>
</html>