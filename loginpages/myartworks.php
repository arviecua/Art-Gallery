<?php
	include('..\dbconnect.php');
	include('..\functions.php');
	
	session_start();
	


	
	$uid = $_SESSION['user'];
	$sql = "SELECT * FROM signup WHERE username = '$uid'; ";
	$first = '';
	$id = '';
	$art_id = '';
	$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$first = $row['first'];
			$id = $row['id'];
		} 
	}

	
	mysqli_free_result($result);
	
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>The Art Gallery</title>
<link href="css/ArtworksUser.css" rel="stylesheet" type="text/css">
<link href="../assets/img/tag.ico" rel="icon" type="image/x-icon" >
</head>
<body>
<!--  YES/NO FUNCTION script for Delete -->
<script type="text/javascript">
function YNconfirm() {
    if (window.confirm('Are you sure you want to delete This Artwork?'))
    {
        return true;
    }
    else
        return false;
};
</script>
<!-- Main Container -->
<div class="wrapper">
		  <div class="logo">
			  <img src="../assets/img/logonew.png" alt="Logo for the are gallery">
		  </div>
	<ul class="nav-area">
	  	  <li><a href="ProjectArtUser.php"> Home </a> </li>
		  <li><a href="about_page_User.php"> About </a> </li>
		  <li><a href="artworksUser.php"> Artwork </a> </li>
		  <li><a href="profile.php"><?php echo $first,' (User)'; ?></a> </li>
		  <li><a href="ProjectArtUser.php?logout='1'">log out</a> </li>
    </ul>
  </div>
<div class="container"> 
  <!-- Header -->
  <header class="header">
	  <h4 class="logo"><em>My Artworks</em></h4>
  </header>
  
        <?php

            $query ="SELECT artwork.art_imagepath,artwork.art_id, artwork.art_title,artwork.art_price, signup.first, signup.last,artwork.art_desc,artwork.art_date,artwork.art_status,artwork.art_category
                         FROM artwork,signup
                        where artwork.id = signup.id AND artwork.art_status = 'available' AND signup.id = $id ORDER BY artwork.art_title ASC";
            $result = mysqli_query($conn,$query);
 if(mysqli_num_rows($result) <=0)
        {
            echo '<br><br><br><br><br><br><br><br><br><h1 align="Center">No Artworks Available </h1><br><br><br><br><br><br><br><br><br>';
        }
        else{
            while($row1 = mysqli_fetch_array($result))
{

                  echo ' <div class="space" >
                            <table  class="pic-table">
                                <tr>
                                    <td>
                                        <a href= "../assets/img/'.$row1['art_imagepath'].'"> <img class="photo" src="../assets/img/'.$row1['art_imagepath'].'" > </a> <br>'.

                                        '<a  href=info_art.php?id='.$row1['art_id'].' class="desc-title"> '.$row1['art_title'].' </a>

                                         <p class="desc-content">'.$row1['art_category'].'</p>

                                         <p class="desc-content" style="float: right;">P'.$row1['art_price'].'.00</p> <br>

                                         <p class="desc-content2">'.$row1['first'].' '.$row1['last'].'</p>
										 
										 <a  href=delete_artwork_User.php?art_id='.$row1['art_id'].' onclick="return YNconfirm();" class="desc-content2"> DELETE.. </a>
                                    </td>
                                </tr>
                            </table>
                        </div>';
            }
}
        echo "<br><br>";


 ?>
	
  <!-- Footer Section -->
  
 
  <!-- Copyrights Section -->

</div>
<!-- Main Container Ends -->
</body>
 <footer id="contact ">
    <div class="buttonContact"> Contact us! </div>
  </footer>
  
	  <div class="copyright">&copy;2022 - <strong>The Art Gallery</strong></div>
</html>
