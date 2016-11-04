<?php 

function insertNewShortURL($theLongURL, $theShortURL) {
	// Connect to database
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
	  
	// Check database connection
	if ( $mysqli->connect_error ) {
		die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
	} 
	    
	// Insert URL into database
	$sql = "INSERT INTO shortenme_urls ( url, users_redirected, shorturl ) VALUES ( '{$mysqli->real_escape_string($theLongURL)}', '{$mysqli->real_escape_string(0)}', '$theShortURL' )";
	$insert = $mysqli->query($sql);
	  
	// Print response from MySQL
	$msg = 'Sorry! An error has occurred. Please notify the webmaster.';
	if ( $insert ) {
		$http = ($_SERVER['HTTPS'] ? 'https://' : 'http://');
		$msg = '<p class="lead">Thanks for your submission.</p><p>Your short URL is: <a href="'.$http.$_SERVER['SERVER_NAME']. '/' .$theShortURL. '">'.$http.$_SERVER['SERVER_NAME']. '/' .$theShortURL. '</a></p><p>You can view information and statistics about your short URL at: <a href="'.$http.$_SERVER['SERVER_NAME']. '/view/' .$theShortURL. '">'.$http.$_SERVER['SERVER_NAME']. '/view/' .$theShortURL. '</a></p>';
	} else {
		die("Error: {$mysqli->errno} : {$mysqli->error}");
	}
	return $msg;
  
	// Close our connection
	$mysqli->close();
	
}

function shortURLExists($theURL) {
	// Connect to database
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
  
	// Check database connection
	if ( $mysqli->connect_error ) {
		die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
	}
 
	$result = $mysqli->query("SELECT `url`, `users_redirected` FROM `shortenme_urls` WHERE shorturl = '$theURL'");

	if ( $result ) {
		$row = $result->fetch_assoc();
		$longURL = $row["url"];
		if ($longURL != ""){
			return true;
		}
		else {
			return false;
		}
	} 
	else {
		die("Error: {$mysqli->errno} : {$mysqli->error}");
	}
	
	// Close our connection
	$mysqli->close();
		
}

function getLongURL($theURL) {
	// Connect to database
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
  
	// Check database connection
	if ( $mysqli->connect_error ) {
		die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
	}
 
	$result = $mysqli->query("SELECT `url`, `users_redirected` FROM `shortenme_urls` WHERE shorturl = '$theURL'");
	
	if ( $result ) {
		$row = $result->fetch_assoc();
		$longURL = $row["url"];
		return $longURL;
	} 
	else {
		die("Error: {$mysqli->errno} : {$mysqli->error}");
	}
	
	// Close our connection
	$mysqli->close();
	
}

function getUsersRedirected($theURL) {
	// Connect to database
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
  
	// Check database connection
	if ( $mysqli->connect_error ) {
		die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
	}
 
	$result = $mysqli->query("SELECT `url`, `users_redirected` FROM `shortenme_urls` WHERE shorturl = '$theURL'");
	
	if ( $result ) {
		$row = $result->fetch_assoc();
		$usersRedirected = $row["users_redirected"];
		return $usersRedirected;
	} 
	else {
		die("Error: {$mysqli->errno} : {$mysqli->error}");
	}
	
	// Close our connection
	$mysqli->close();
	
}

function increaseUsersRedirected($theURL) {
	// Connect to database
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
  
	// Check database connection
	if ( $mysqli->connect_error ) {
		die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
	}
 
	$result = $mysqli->query("SELECT `url`, `users_redirected` FROM `shortenme_urls` WHERE shorturl = '$theURL'");
	
	if ( $result ) {
		$row = $result->fetch_assoc();
		// Get current value of users_redirected
		$usersRedirected = $row["users_redirected"];
		// Increase value of users redirected by 1
		$usersRedirected++;
		$result = $mysqli->query("UPDATE shortenme_urls SET users_redirected='$usersRedirected' WHERE shorturl = '$theURL'");
	} 
	else {
		die("Error: {$mysqli->errno} : {$mysqli->error}");
	}
	
	// Close our connection
	$mysqli->close();
	
}

function hashURL($theURL) {
	// Hash the URL
	$hashedURL = hash('sha256', $theURL);
	// Grab first 7 characters of hash for short URL
	$shortURL = substr($hashedURL, 0, 7);

	// Make sure short URL does not already exist in database. 
	if (!shortURLExists($shortURL)) {
		//short URL does not already exist in database. OK to use this new short URL.
		return $shortURL;
	}
	else {
		// short URL already exists in database. Hash the hash to get a different short URL.
		return hashURL($hashedURL);
	}

}

function getAllURLs() {
	// Connect to database
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
  
	// Check database connection
	if ( $mysqli->connect_error ) {
		die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
	}
 
	$result = $mysqli->query("SELECT `url`, `users_redirected`, `shorturl` FROM `shortenme_urls`");
	
	if ( $result->num_rows > 0 ) {
		echo '<div class="inner cover"><div class="table-responsive"><table class="table">';
		echo '<tr><th class="shorturl"><strong>Shortened URL</strong></th><th class="longurl"><strong>Long URL</strong></th><th class="users-redirected"><strong>Number of Users Redirected</strong></th></tr>';
		$http = ($_SERVER['HTTPS'] ? 'https://' : 'http://');
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo '<tr><td class="shorturl"><a href="'.$http.$_SERVER['SERVER_NAME']. '/' .$row["shorturl"]. '">' .$http.$_SERVER['SERVER_NAME']. '/' .$row["shorturl"]. '</a></td><td class="longurl"><a href="' .$row["url"]. '">' .$row["url"]. '</a></td><td class="users-redirected">' .$row["users_redirected"]. '</td></tr>';
		}
		echo '</table></div></div>';
	} 
	else {
		echo '<div class="inner cover">Sorry! There are no short URLs in the database.</div>';
	}
	
	// Close our connection
	$mysqli->close();
	
}
