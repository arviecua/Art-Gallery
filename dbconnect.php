<?php
$conn = mysqli_connect('localhost','arvie','arviecua29','art_gallery');

	if(!$conn){
		echo 'Connection error' . mysqli_connect_error();
	}

?>