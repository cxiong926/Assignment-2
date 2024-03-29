<?php

require_once('../classes/Template.php');
require_once("../classes/DB.class.php");
require_once("../classes/Validate.php");
session_start();

$db = new DB();

// Error message if anything is invalid
$errorMsg = "";

//Safe vars  

$safeEmail = "";
$safeRealName = "";
$safeAddress = "";
$safeZipCode = "";

// Checks if user visited the three forms
if(isset($_SESSION['p1']) && isset($_SESSION['p2']) && isset($_SESSION['p3'])){
	

	// Updates session variables if there are changes
	if(isset($_SESSION['email'])){
		if($_POST["email"] != $_SESSION['email']){
			
			$_SESSION['email'] = validateSanitizeEmail($_POST["email"]);
			
			if(!empty($_SESSION['email'])){
				header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/confirm.php');
				exit();
			}
			
		}
	}

	if(isset($_SESSION['realName'])){
		if($_POST["realName"] != $_SESSION['realName']){
			
			$_SESSION['realName'] = validateSanitizeString($_POST["realName"]);
			
			if(!empty($_SESSION['realName'])){
				header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/confirm.php');
				exit();
			}
		}
	}

	if(isset($_SESSION['address'])){
		if($_POST["address"] != $_SESSION['address']){
			
			$_SESSION['address'] = validateSanitizeString($_POST["address"]);
			
			if(!empty($_SESSION['address'])){
				header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/confirm.php');
				exit();
			}
			
		}
	}

	// Verifies zip code if there are changes
	if(isset($_SESSION['zipCode'])){
		if($_POST["zipCode"] != $_SESSION['zipCode']){
			
			$safeZipCode = validateSanitizeString($_POST["zipCode"]);
			
		}
	}

	// Web service runs if safeZipCode is !empty after validation
		if(!empty($safeZipCode)){
			
			//web service
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
				
				header('Location: http://cnmtsrv2.uwsp.edu/~bxion419/Assignment2/php/confirm.php');
				exit();
				} 
			else {
				$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter one of the valid zip codes</li>';
			}

			curl_close($ch);
			
		}
		

	// Error messages if any fields are empty
	if(empty($_SESSION['email'])){
			$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid email address</li>';
	}
			
	if(empty($_SESSION['password'])){
			$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a <a class="" href="basicreg.php">valid password</a></li>';
	}

	if(empty($_SESSION['realName'])){
			$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter your real name</li>';
	}

	if(empty($_SESSION['address'])){
			$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter your address</li>';
	}

	if(empty($_SESSION['zipCode'])){
			$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid zip code</li>';
	}

	if(empty($_SESSION['city']) || empty($_SESSION['state'])){
			$errorMsg .= '<li class = "text-center list-group-item border-0">Please enter a valid zip code for your city and state</li>';
	}

}

$page = new Template('Confirmation'); // Automatically sets title

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
print '<a class="nav-link disabled" >Step 1 - Basic Registration</a>';
print '</li>';

print '<li class="nav-item ">';
print '<a class="nav-link disabled" >Step 2 - Address</a>';
print '</li>';

print '<li class="nav-item active">';
print '<a class="nav-link " >Step 3 - Confirmation</a>';
print '</li>';

print '</ul>';
print '</div>';
print '</nav>';

// Error message if user hasn't visited all forms
if(empty($_SESSION['p1']) || empty($_SESSION['p2']) || empty($_SESSION['p3'])){
	print '<div class="container wrapper">';
	print '<h1 class="uw">Register for an Account (Step 3)</h1><hr>';
	print '<div class="border rounded col-md-10 mx-auto px-4 pb-3">';
	print '<h2 class="mt-3 text-center">Something went wrong</h2>';
	print '<p class="mt-3 text-center">Any progress has been saved</p>';
	print '<div class="text-center"><a href="basicreg.php">Return to Step 1</a></div>';
	print '</div>';
	print '</div>';
	exit();
}

// Displays a message if $errorMsg is > 0
if (strlen($errorMsg) > 0){
	print '<div class="container wrapper">';
	print '<h1 class="uw">Register for an Account (Step 3)</h1><hr>';

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
	
	if (!$db->getConnStatus()) {
		print "An error has occurred with connection\n";
		exit;
	}
					
	 //INSERT statement for userinfo					
	$query = 'INSERT INTO userinfo VALUES ("'.$_SESSION['email'].'", 
												"'.$_SESSION['password'].'", 
												"'.$_SESSION['realName'].'", 
												"'.$_SESSION['address'].'", 
												"'.$_SESSION['zipCode'].'", 
												"'.$_SESSION['city'].'", 
												"'.$_SESSION['state'].'", 
												now())'; 
	$db->dbCall($query);
	
	print '<div class="container wrapper">';
	print '<h1 class="uw">Registered!</h1><hr>';
	print '<h2 class="text-center mt-4">Thank you for registering, '. $_SESSION["realName"] .'!</h2><br>';
	print '<div class="text-center"><a href="basicreg.php">Register again</a></div>';
	print '</div>';
	
	// Unset and destroy session after INSERT
	unset($_SESSION['email']);
	unset($_SESSION['password']);
	unset($_SESSION['realName']);
	unset($_SESSION['address']);
	unset($_SESSION['zipCode']);
	unset($_SESSION['city']);
	unset($_SESSION['state']);
	unset($_SESSION['visited']);
	session_destroy();
}

print $page->getBottomSection(); // closes the html



?>