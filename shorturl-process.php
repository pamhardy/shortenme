<?php	
	
	$shortURL =  substr($currentURI, 1);
	
	$longURL = getLongURL($shortURL);
		if ($longURL != ""){
			increaseUsersRedirected($shortURL); // Increase value of users redirected by 1
			header( "Location: $longURL" ) ;	// redirect to the long URL
		}
		else {
			include_once('header.php'); // load header
			echo "Error! That short URL could not be found.";
		}
