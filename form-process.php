<?php

	$url = $_POST['inputURL'];
	
	// Remove all illegal characters from a url and all leading/trailing whitespace
	$url = trim(filter_var($url, FILTER_SANITIZE_URL));
	
	// Remove all illegal characters from vanity URL
	$newVanityURL = preg_replace("/[^ \w]+/", "", $_POST['vanityURL']);
	
	// Validate url
	if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
		// If user wants a vanity url but the vanity url is not valid
		if ((strlen($url) > 2000)) {
			$msg = "Sorry! Your URL is too long. Please reduce your URL to less than 2000 characters and try again!";
		}
		else if ($_POST['vanityURLDesired'] == 'on'){
			if (($newVanityURL == '') || (empty($newVanityURL)) ) {
				$msg = "Sorry! You left your vanity URL blank. Please enter a vanity URL and try again!";
			}
			else if ($newVanityURL != $_POST['vanityURL']) {
				$msg = "Sorry! That vanity URL is not a valid URL. Please remove all characters except for letters and numbers and try again!";
			}
			else if (strlen($newVanityURL) > 20) {
				$msg = "Sorry! That vanity URL is too long. Please reduce your vanity URL to 20 characters or less and try again!";
			}
			else if (shortURLExists($newVanityURL)) {
				$msg = "Sorry! That vanity URL is already taken. Please choose a different vanity URL!";
			}
			else {
				$shortURL = $newVanityURL;
				// Insert the long and short URLs into the database
				$msg = insertNewShortURL($url, $shortURL);
			}	
		}	
		else if (($_POST['vanityURLDesired'] == 'off') || (($newVanityURL == $_POST['vanityURL']) && !shortURLExists($newVanityURL) )) {

			// Hash the URL
			$shortURL = hashURL($url);
			
			// Insert the long and short URLs into the database
			$msg = insertNewShortURL($url, $shortURL);

		}
		else {
			$msg = 'Sorry! An error has occured. Please inform the webmaster about the issue.';
		}
	    
	} 
	else {
	    $msg = "Sorry! $url is not a valid URL. Please try again!";
	} 
	
?>

          <div class="inner cover">
		    
		  <?php echo $msg; ?>

		  <p><a href="/">Go Back Home</a></p>
          </div>
