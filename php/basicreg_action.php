<?php

require_once('../classes/Template.php');
require_once("../classes/DB.class.php");
require_once("../classes/Validate.php");
session_start();
$db = new DB();

// Error message if anything is invalid
$errorMsg = "";

//Safe vars  
$passwordVerification = false;
$safeEmail = "";
$safePassword = "";
$safePassword2 = "";

$page = new Template('Registration'); // Automatically sets title

$page->addHeadElement('<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>');
$page->addHeadElement('<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>');
$page->addHeadElement('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">');

$page->addHeadElement('<link href="../style/style.css" rel="stylesheet">');
$page->addHeadElement('<script src="../scripts/scripts.js"></script>');

$page->addHeadElement('<link rel="icon" type="image/png" href="../images/me.png">');
$page->finalizeTopSection(); // Closes head section
$page->finalizeBottomSection();


print $page->getTopSection();
print '<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">';
print '<span class="navbar-brand mb-0 h1">Assignment 2</span>';
print '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">';
print '<span class="navbar-toggler-icon"></span>';
print '</button>';
print '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
print '<ul class="navbar-nav mr-auto">';

print '<li class="nav-item active">';
print '<a class="nav-link" >Step 1 - Basic Registration</a>';
print '</li>';

print '<li class="nav-item ">';
print '<a class="nav-link disabled" >Step 2 - Address</a>';
print '</li>';

print '<li class="nav-item ">';
print '<a class="nav-link disabled" >Step 3 - Confirmation</a>';
print '</li>';

print '</ul>';
print '</div>';
print '</nav>';

// Email logic.  Checks isset/!empty.  Trims/real_escape_strings/sanitizes/validates.  Creates an error if nothing entered or invalid selection
 if (isset($_POST["email"]) && !empty($_POST["email"])){
	 
	$safeEmail = validateSanitizeEmail($_POST["email"]);
	 
	if(empty($safeEmail)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid email Address</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid email Address</li>';
} 

// password check
if (isset($_POST["password"]) && !empty($_POST["password"])){
	
	$safePassword = validateSanitizeString($_POST["password"]);
	
	if(empty($safePassword)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid password</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a password</li>';
}

// password2 check
if (isset($_POST["password2"]) && !empty($_POST["password2"])){
	
	$safePassword2 = validateSanitizeString($_POST["password2"]);
	
	if(empty($safePassword2)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please verify your password</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please verify your password</li>';
}

// logic if passwords match
if($safePassword === $safePassword2){
	$passwordVerification = true;
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Passwords do not match</li>';
}

// Valid email and passwords
if (strlen($errorMsg) == 0 && $passwordVerification = true){
	$_SESSION['email'] = $safeEmail;
	$_SESSION['password'] = $safePassword;
	
	header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/addr.php');
}
else{
	print '<div class="container wrapper">';
	print '<h1 class="uw">Register for an Account (Step 1)</h1><hr>';

	print '<div class="border rounded col-md-10 mx-auto px-4 pb-3">';
	if(!empty($_SESSION['p1'])){
		print '<h2 class="mt-3 text-center">The following errors were found</h2>';
		print '<ul class="list-group list-group-flush">';
		print $errorMsg;
		print '</ul>';
		print '<div class="col text-center">';
		print '<button type="submit" class="btn btn-primary mt-3" onclick="goBack()">Back</button>';
	}
	else{
		print '<h2 class="mt-3 text-center">Something went wrong</h2>';
		print '<p class="mt-3 text-center">Any progress has been saved</p>';
		print '<div class="text-center"><a href="basicreg.php">Return to Step 1</a></div>';
	}

	print '</div>';
	print '</div>';

	print '</div>';
}

print $page->getBottomSection(); // closes the html

?>


