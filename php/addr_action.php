<?php

require_once('../classes/Template.php');
require_once("../classes/DB.class.php");
require_once("../classes/Validate.php");
session_start();

$db = new DB();
$filter = new Validate();

// Error message if anything is invalid
$errorMsg = "";

//Regular and safe vars.  
$realName = "";
$address = "";
$zipCode = "";

$safeRealName = "";
$safeAddress = "";
$safeZipCode = "";

// Runs webservice if form was filled out
/* if(isset($_POST["realName"]) && isset($_POST["address"]) && isset($_POST["zipCode"])){
	
	
	//Tried creating a class for this, confused
	$safeRealName = $filter->validateSanitizeString($_POST["realName"]);
	print $safeRealName;
	
	$realName = trim($_POST["realName"]);
	$safeRealName = $db->dbEsc($realName);
	$safeRealName = filter_var($safeRealName, FILTER_SANITIZE_STRING);
	
	$address = trim($_POST["address"]);
	$safeAddress = $db->dbEsc($address);
	$safeAddress = filter_var($safeAddress, FILTER_SANITIZE_STRING);
	
	$zipCode = trim($_POST["zipCode"]);
	$safeZipCode = $db->dbEsc($zipCode);
	$safeZipCode = filter_var($safeZipCode, FILTER_SANITIZE_STRING);

}
else{
	$errorMsg .= '<li class = "Please fill out the film</li>';
} */

// Email logic.  Checks isset/!empty.  Trims/real_escape_strings/sanitizes/validates.  Creates an error if nothing entered or invalid selection
if (isset($_POST["realName"]) && !empty($_POST["realName"])){
	$realName = trim($_POST['realName']);

	$safeRealName = filter_var($realName, FILTER_SANITIZE_STRING);
	$safeRealName = $db->dbEsc($safeRealName);
	if(empty($safeRealName)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid real name</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid real name</li>';
}

// Email logic.  Checks isset/!empty.  Trims/real_escape_strings/sanitizes/validates.  Creates an error if nothing entered or invalid selection
if (isset($_POST["address"]) && !empty($_POST["address"])){
	$address = trim($_POST['address']);

	$safeAddress = filter_var($address, FILTER_SANITIZE_STRING);
	$safeAddress = $db->dbEsc($safeAddress);
	if(empty($safeAddress)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid address</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid address</li>';
}


// Email logic.  Checks isset/!empty.  Trims/real_escape_strings/sanitizes/validates.  Creates an error if nothing entered or invalid selection
if (isset($_POST["zipCode"]) && !empty($_POST["zipCode"])){
	$zipCode = trim($_POST['zipCode']);

	$safeZipCode = filter_var($zipCode, FILTER_SANITIZE_STRING);
	$safeZipCode = $db->dbEsc($safeZipCode);
	if(empty($safeZipCode)){
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid zip code</li>';
	}
}
else{
	$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid zip code</li>';
}



$page = new Template('Address Data'); // Automatically sets title

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

print '<li class="nav-item ">';
print '<a class="nav-link" href="basicreg.php">Basic Register (Step 1)</a>';
print '</li>';

print '<li class="nav-item active">';
print '<a class="nav-link" href="addr.php">Address (Step 2)</a>';
print '</li>';

print '<li class="nav-item ">';
print '<a class="nav-link" href="confirm.php">Confirm (Step 3)</a>';
print '</li>';

print '</ul>';
print '</div>';
print '</nav>';

// Web service runs if safeRealName, safeAddress, safeZipCode are !empty
if(!empty($safeRealName) && !empty($safeAddress) && !empty($safeZipCode)){
	
	$_SESSION['realName'] = $safeRealName;
	$_SESSION['address'] = $safeAddress;

	$data = array("username" => "bxion419",
					"apikey" => "nv2kjc7gu1f2bs7k",
					"zip" => $safeZipCode);

	// json_encode the data before sending
	$dataJson = json_encode($data);

	$url = "http://cnmt310.braingia.org/ziplookup.php";

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);

	$return = curl_exec($ch);

	// Check HTTP Status
	$httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	if ($httpStatus != 200) {
		print "Something went wrong with the request: " . $httpStatus;
		curl_close($ch);
		exit;
	}

	// Decode the return object
	$resultObject = json_decode($return);

	// Verify returnobject contains what's expected.
	if (!is_object($resultObject)) {
			print "Something went wrong decoding the return";
			curl_close($ch);
			exit;
	}
	
	
	// Check for presence of an errorMessage property in the resultObject
	if (property_exists($resultObject,"ErrorMessage")) {
			$errorMsg .= $resultObject->ErrorMessage;	
	} 
	//  If no error, sets city, state, and zipCode session variables
	elseif (property_exists($resultObject,"city") && property_exists($resultObject,"state")) {
		$_SESSION['city'] = $resultObject->city;
		$_SESSION['state'] = $resultObject->state;
		$_SESSION['zipCode'] = $safeZipCode;
		} 
	else {
		$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter one of the valid zip codes</li>';
	}

	curl_close($ch);
	
}

// Displays a message if $errorMsg is > 0
if(strlen($errorMsg) > 0){

	print '<div class="container wrapper">';
	print '<h1 class="uw">Register for an Account (Step 2)</h1><hr>';

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
else{
	header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/confirm.php');
}

print $page->getBottomSection(); // closes the html

?>