function goBack() {
	window.history.back();
}

// Search validation
function searchValidate(){
	let x = document.forms["searchForm"]["search"].value.trim();
	if (x == "") {
		$( "#searchError" ).empty();
		$( "#searchError" ).append( "Please enter a search term" );
		$("#searchError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
		document.searchForm.search.focus();
		return false;
	}
	else{
		$( "#searchError" ).empty();
	}
}

// Login Validation
function loginValidate(){
	let x = document.forms["loginForm"]["userName"].value;
	let y = document.forms["loginForm"]["password"].value;
	let z = 1;
	let t = 1;
	
	// userName validation
	if (x == "") {
		$( "#userNameError" ).empty();
		$( "#userNameError" ).append( "Please enter a username" );
		$("#userNameError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
		document.loginForm.userName.focus();
	}
	else{
		$( "#userNameError" ).empty();
		z = 0;
	}
	
	// Password Validation
	if (y == "") {
		$( "#passwordError" ).empty();
		$( "#passwordError" ).append( "Please enter a password" );
		$("#passwordError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
		document.loginForm.password.focus();
		
	}
	else{
		$( "#passwordError" ).empty();
		t = 0;
	}
	if(z == 0 && t == 0){
		return true
	}
	else{
		return false;
	}
}

// Survey Validation
function surveyValidate(){
	let email = document.forms["surveyForm"]["email"].value;
	let checkboxes = document.getElementsByName("major[]");
	let emailFormat = /[a-z0-9]+\@[a-z0-9]+\.[a-z]{2,4}/i;
	let major = "";
	let grade = document.forms["surveyForm"]["grade"].value;
	let topping = document.forms["surveyForm"]["topping"].value;
	let validEmail = 1;
	let validMajor = 1;
	let validGrade = 1;
	let validTopping = 1;
	
	// Email validation
	if(!email.match(emailFormat)){
		$("#emailError").empty();
		$("#emailError").append( "Please enter a valid email" );
		$("#emailError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
	}
	else{
		$("#emailError").empty();
		validEmail = 0;
	}
	
	// Major validation with for loop to get checkbox values
	for (var i=0, n=checkboxes.length;i<n;i++) {
		if (checkboxes[i].checked) {
			major += checkboxes[i].value;
		}
	}
	if (major == "") {
		$("#majorError").empty();
		$("#majorError").append("Please select a major");
		$("#majorError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
	}
	else{
		$("#majorError").empty();
		validMajor = 0;
	}
	
	// Grade Validation
	if (grade == "") {
		$("#gradeError").empty();
		$("#gradeError").append("Please select a grade");
		$("#gradeError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
	}
	else{
		$( "#gradeError" ).empty();
		validGrade = 0;
	}
	
	// Topping Validation
	if (topping == "") {
		$("#toppingError").empty();
		$("#toppingError").append("Please select a topping");
		$("#toppingError").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
	}
	else{
		$( "#toppingError" ).empty();
		validTopping = 0;
	}
	
	if(validEmail == 0 && validMajor == 0 && validGrade == 0 && validTopping == 0){
		return true
	}
	else{
		return false;
	}
}



	
