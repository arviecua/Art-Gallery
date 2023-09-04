<?php

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

?>


