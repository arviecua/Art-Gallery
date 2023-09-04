<?php
ob_start();
include('../dbconnect.php');
include('../functions.php');
$art_id = $_GET["art_id"];
$sql = "DELETE from artwork WHERE art_id=$art_id;";
if(mysqli_query($conn,$sql)){
	echo "Record updated successfully";
	redirect_to("myartworks.php");
}
else{
	echo "error";
}


?>