<?php 

require_once 'config.php'; // database settings
include_once('functions.php'); // functions

$currentURI = $_SERVER['REQUEST_URI']; // get current URI

if (substr($currentURI, 0, 5) == "/view") {
	include_once('header.php'); // load header
	include_once('view.php'); // load the short URL view page
}
else if (($currentURI == "/index.php") || ($currentURI == "/")) {
	include_once('header.php'); // load header
	if ( ! empty( $_POST[inputURL] ) ) {
		include_once('form-process.php'); // process the URL shortener form
	}
	else {
		include_once('home.php'); // load home
	}
}
else {
	include_once('shorturl-process.php'); // process the short URL
}

include_once('footer.php'); // load footer
