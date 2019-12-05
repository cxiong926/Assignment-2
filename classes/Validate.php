<?php

require_once("DB.class.php");


function validateSanitizeString($string) {
	$db = new DB();
	$safeString = trim($string);
	$safeString = $db->dbEsc($safeString);
	$safeString = filter_var($safeString, FILTER_SANITIZE_STRING);
	return $safeString;
}
function validateSanitizeEmail($string) {
	$db = new DB();
	$safeString = trim($string);
	$safeString = $db->dbEsc($safeString);
	$safeString = filter_var($safeString, FILTER_SANITIZE_EMAIL);
	$safeString = filter_var($safeString, FILTER_VALIDATE_EMAIL);
	return $safeString;
}

?>
