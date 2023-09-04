<?php
include ("dbconnect.php");
include ("functions.php");
$id = $_GET["id"];
$sql = "DELETE from signup WHERE id=$id;";
if(mysqli_query($conn,$sql)){
	redirect_to("admin_user.php");
}
else{
	echo "error";
}


?>