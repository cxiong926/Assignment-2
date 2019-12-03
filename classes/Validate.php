<?php

require_once("DB.class.php");

$db = new DB();

class Validate {

	//private $_bottom;

	// What do with this?
	function __construct() {
		;
	}



	function validateSanitizeString($string) {
		$safeString = trim($string);
		$safeString = dbEsc($safeString);
		//$safeString = $db->dbEsc($safeString);
		$safeString = filter_var($safeString, FILTER_SANITIZE_STRING);
		return $safeString;
	} 



} // end class

?>
