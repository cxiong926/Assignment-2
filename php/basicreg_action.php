<?php

require_once('../classes/Template.php');
require_once("../classes/DB.class.php");
session_start();
$db = new DB();

// $_SESSION['name']
// $_POST["email"]

// Error message if anything is invalid
$errorMsg = "";

//Regular and safe vars.  
$passwordVerification = false;
$email = "";
$password = "";
$password2 = "";

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
print '<a class="nav-link" href="basicreg.php">Basic Register (Step 1)</a>';
print '</li>';

print '<li class="nav-item ">';
print '<a class="nav-link" href="addr.php">Address (Step 2)</a>';
print '</li>';

print '<li class="nav-item ">';
print '<a class="nav-link" href="confirm.php">Confirm (Step 3)</a>';
print '</li>';

print '</ul>';
print '</div>';
print '</nav>';



/* Tried creating a class for this, confused.  It'll be easier to use a function rather than type it all out everytime.
	$safeRealName = $filter->validateSanitizeString($_POST["realName"]);
	print $safeRealName; */





// Email logic.  Checks isset/!empty.  Trims/real_escape_strings/sanitizes/validates.  Creates an error if nothing entered or invalid selection
if (isset($_POST["email"]) && !empty($_POST["email"])){
	$email = trim($_POST['email']);

	$safeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
	$safeEmail = filter_var($safeEmail, FILTER_VALIDATE_EMAIL);
	$safeEmail = $db->dbEsc($safeEmail);
	if(empty($safeEmail)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid email Address</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid email Address</li>';
}


// password check
if (isset($_POST["password"]) && !empty($_POST["password"])){
	$password = trim($_POST['password']);

	$safePassword = filter_var($password, FILTER_SANITIZE_STRING);
	$safePassword = $db->dbEsc($safePassword);
	
	if(empty($safePassword)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid password</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a password</li>';
}


// password2 check
if (isset($_POST["password2"]) && !empty($_POST["password2"])){
	$password2 = trim($_POST['password2']);

	$safePassword2 = filter_var($password2, FILTER_SANITIZE_STRING);
	$safePassword2 = $db->dbEsc($safePassword2);
	
	if(empty($safePassword)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please verify your password</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please verify your password</li>';
}

// logic if passwords match
if ($safePassword === $safePassword2){
	$passwordVerification = true;
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Passwords do not match</li>';
}

// Valid email and passwords
// Maybe add a destroy session if user goes back to first page?
if (strlen($errorMsg) == 0 && $passwordVerification === true){
	$_SESSION['email'] = $safeEmail;
	$_SESSION['password'] = $safePassword;
	
	header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/addr.php');
	
	/* print '<div class="container wrapper">';
	print '<h1 class="uw">Register for an Account</h1><hr>';
	//print '<h2 class="text-center mt-4"></h2><br>';

	
	
	print 'str length: ' . strlen($errorMsg);
	print '<br>email: ' . $_SESSION['email'];
	print '<br>password: ' . $_SESSION['password'];
	print '<br>Verification: ' . $passwordVerification;

	print '<div class="border rounded col-md-10 mx-auto px-4 pb-3">';
	print '<h2 class="mt-3 text-center">Good email and pw</h2>';
	print '<ul class="list-group list-group-flush">';
	print '</ul>';
	print '<div class="col text-center">';
	print '<button type="submit" class="btn btn-primary mt-3" onclick="goBack()">Back</button>';

	print '</div>';
	print '</div>';

	print '</div>'; */
}
else{
	print '<div class="container wrapper">';
	print '<h1 class="uw">Register for an Account (Step 1)</h1><hr>';

	print '<div class="border rounded col-md-10 mx-auto px-4 pb-3">';
	print '<h2 class="mt-3 text-center">The following errors were found</h2>';
	print '<ul class="list-group list-group-flush">';
	print $errorMsg;
	print '</ul>';
	print '<div class="col text-center">';
	print '<button type="submit" class="btn btn-primary mt-3" onclick="goBack()">Back</button>';

	print '</div>';
	print '</div>';

	print '</div>';
}

print $page->getBottomSection(); // closes the html

?>


