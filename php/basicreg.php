<?php

require_once('../classes/Template.php');
session_start();

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




print '<div class="container wrapper">';
print '<h1 class="uw">Register for an Account (Step 1)</h1><hr>';
print '<p class="text-center">Please enter your email and create a password for you account.</p>';

// Form
print '<form class="border rounded col-md-10 mx-auto px-4" name="registrationForm" method="POST" action="basicreg_action.php">';

// Email
print '<div class="form-group row mt-3 mb-2">';
print '<label class="col-sm-4 col-form-label">Email Address</label>';
print '<div class="col-sm-8">';
if(isset($_SESSION['email'])){
	print '<input type="text" name="email" value="' . $_SESSION['email'] . '" class="form-control">';
}
else{
	print '<input type="text" name="email" class="form-control">';
}
print '</div>';
print '</div>';

// Password
print '<div class="form-group row mt-3 mb-2">';
print '<label class="col-sm-4 col-form-label">Password</label>';
print '<div class="col-sm-8">';
print '<input type="password" name="password" class="form-control">';
print '</div>';
print '</div>';

// Verify password
print '<div class="form-group row mt-3 mb-2">';
print '<label class="col-sm-4 col-form-label">Verify Password</label>';
print '<div class="col-sm-8">';
print '<input type="password" name="password2" class="form-control">';
print '</div>';
print '</div>';

// Next button
print '<div class="mb-2 form-group row">';
print '<div class="col text-center">';
print '<button type="submit" name="submit" class="btn btn-primary">Next</button>';
print '</div>';
print '</div>';



print '</form>';



// container div end tag
print '</div>';

print $page->getBottomSection(); // closes the html

?>



