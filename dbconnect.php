<?php
$conn = mysqli_connect('localhost','irpnmlfm_art_gallery','!Academart2022','irpnmlfm_art_gallery');

	if(!$conn){
		echo 'Connection error' . mysqli_connect_error();
	}

?>