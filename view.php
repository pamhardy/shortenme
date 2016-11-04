<?php

    $shortURL = substr($currentURI, 6);
       
	if ($shortURL != "") {
		// See if short URL exists in database
		if (shortURLExists($shortURL)) {
			$longURL = getLongURL($shortURL);
			$http = ($_SERVER['HTTPS'] ? 'https://' : 'http://');
			$msg = '<p class="lead">Information for Shortened URL</p><p>Shortened URL: <a href="'.$http.$_SERVER['SERVER_NAME']. '/' .$shortURL. '">' .$http.$_SERVER['SERVER_NAME']. '/' .$shortURL. '</a></p><p>Long URL: <a href="' .$longURL. '">' .$longURL. '</a></p><p>Number of Users Redirected: ' .getUsersRedirected($shortURL). '</p>';
		}
		else {
			$msg = 'Sorry, we could not find that short URL in the database.';
		}
		
	}
	else {
		getAllURLs();
	}

?>

          <div class="inner cover">
		    
		  <?php echo $msg; ?>

          </div>
