<?php
	
	include('..\dbconnect.php');
	include ('..\functions.php');
	session_start();
	
	
	$streetAdd='';
	$brgy='';
	$city='';
	$courier='';

	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ..\login.php');
}
	
	
	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ..\ProjectArt.php");
}


	$id=$_GET['id'];
	$art_id=$_GET['art_id'];

if(isset($_POST['submit'])){
	
	
	
	$streetAdd = $_POST['streetAdd'];
	$brgy = $_POST['brgy'];
	$city = $_POST['city'];
	$courier = $_POST['courier'];
	
	$_SESSION['streetAdd'] = $streetAdd;
	$_SESSION['brgy'] = $brgy;
	$_SESSION['city'] = $city;
	$_SESSION['courier'] = $courier;
	
	


	
}
	

	// VIEW selecting user_details from user_view
	$sql = "SELECT * FROM user_view WHERE id = $id; ";
	
	$first = '';
	$last = '';
	$contact = '';
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$first = $row['first'];
			$last = $row['last'];
			$contact = $row['contact'];
			
		} 
	}

	$art_imagepath = '';
	$art_title = '';
	$date_purchase = date('Y/m/d');
	$art_price = '';
	
	// VIEW selecting data from artwork_view
	$query_category1="SELECT * FROM artwork_view WHERE art_id = $art_id";
	
    $result_category1 = mysqli_query($conn,$query_category1);
	if(mysqli_num_rows($result_category1)>0){
		while($row1 = mysqli_fetch_array($result_category1)){
			$art_imagepath = $row1['art_imagepath'];
			$art_title = $row1['art_title'];
			$art_price = $row1['art_price'];
			
		} 
	}
		
	
	
	if(isset($_GET['buy'])){
		
		$streetAdd1 = $_SESSION['streetAdd'];
		$brgy1 = $_SESSION['brgy'];
		$city1 = $_SESSION['city'];
		$courier1 = $_SESSION['courier'];
		$artist_id = '';
		$art_price = '';
		$query_category1="SELECT * FROM artwork_view WHERE art_id = $art_id";
		$result_category1 = mysqli_query($conn,$query_category1);
		if(mysqli_num_rows($result_category1)>0){
			while($row1 = mysqli_fetch_array($result_category1)){
				$artist_id = $row1['id'];
				$art_price = $row1['art_price'];

			} 
		}
		
		

		$query = "INSERT INTO order_t(order_date, art_id, artist_id, id, shipping_street, shipping_brgy, shipping_city, courier, art_price) VALUES(now(),'$art_id','$artist_id', '$id', '$streetAdd1', '$brgy1', '$city1', '$courier1', '$art_price');";
		
		if(mysqli_query($conn,$query)){
				redirect_to('myorders.php');
			}else{
				echo 'error in the database';
			
			}
		
		
		
	}


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>The Art Gallery | Buy now!</title>
<link href="css/buy_page.css" rel="stylesheet" type="text/css">
</head>
	
<body>
 <form action="order_summary.php?id=<?php echo $id;?>&art_id=<?php echo $art_id;?>" method="POST">
	<div class= "top">
		<span style="color:#1AB8C4;font-size: 60px">Order</span>
		<span style="color:#000000; font-size: 60px">summary</span>
	</div>
	<hr>
	<div class="middle">

		<h1><?php echo $first,' ',$last;?></h1>
		<p>User ID:  <?php echo $id;?></p>
		<p>Address:  <?php echo $streetAdd,', ',$brgy,', ',$city;?></p>
		<p>Contact No:  <?php echo $contact;?> </p>
		<p>Courier:  <?php echo $courier;?></p>
	</div>
	<hr>
	<div class= "container">
		<div class="column">
			<img src="../assets/img/<?php echo $art_imagepath;?>" alt="the artwork to be bought">
		</div>
		<div class="column">
			<h1><?php echo $art_title;?></h1>
			<p>Art id: <?php echo $art_id;?></p>
			<p>Date of purchase: <?php echo $date_purchase;?></p> 
		</div>
		<div class="column">
			<br><br><p1>Price: <?php echo $art_price;?></p1>
		</div>
	</div>
	<hr>
	
	<div class="bottom">
		<p1>Proceed to buy?</p>
		<a href="order_summary.php?id=<?php echo $id;?>&art_id=<?php echo $art_id;?>&buy='1'">buy</a>
		<a href="profile.php">Cancel</a>
	</div>
     </form>

</body>

</html>
