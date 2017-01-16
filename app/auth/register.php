<?php
require __DIR__."/../../autoload.php";

//validation error codes defined as constants
define("REG_SUCCESS", "0");
define("MISSING_INPUT", "1");
define("INVALID_EMAIL", "2");
define("TERMS_NOT_ACCEPTED", "3");
define("EMAIL_ALREADY_REG", "4");
define("USERNAME_TAKEN", "5");

function validateRegistrationFields () {
	// Check if all fields has input
  foreach($_POST as $input=>$value) {
    if(empty($_POST[$input])) {
      return MISSING_INPUT;
    }
  }
  // Validate email
  if (!filter_var($_POST["emailReg"], FILTER_VALIDATE_EMAIL)) {
    return INVALID_EMAIL;
  }
  // Validation to check if terms and conditions are accepted
  if(!isset($_POST["terms"])) {
    return TERMS_NOT_ACCEPTED;
  }
  return REG_SUCCESS;
}

// Check if email or username is already registered
function checkEmailAndUsername($db, $email, $username) {
	$checkEmailQuery = "SELECT email FROM users WHERE email = '{$email}'";
	$checkEmailStatement = $db->query($checkEmailQuery);
	// if rows found in query
	if ($checkEmailStatement->rowCount() > 0 ) {
     return EMAIL_ALREADY_REG;
  }
	$checkUsernameQuery = "SELECT username FROM users WHERE username = '{$username}'";

	$checkUsernameStatement = $db->query($checkUsernameQuery);
	// if rows found in query
	if ($checkUsernameStatement->rowCount() > 0 ) {
     return USERNAME_TAKEN;
  }
	return REG_SUCCESS;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["registerSubmit"])) {
	  // escape input to avoid exploit attempts
	  foreach($_POST as $input=>$value) {
	    $_POST[$input] = escapeInput($value);
	  }
	  // call function to validate input
	  $result = validateRegistrationFields();

	  // output error messages if something is wrong
	  if ($result == MISSING_INPUT) {
	    $_SESSION["error"] = "Please fill out all fields.";
	  } else if ($result == INVALID_EMAIL) {
	    $_SESSION["error"] = "You must enter a valid email.";
	  } else if ($result == TERMS_NOT_ACCEPTED){
	    $_SESSION["error"] = "You have to accept our terms.";
	  } else {
	    // prepare user info for database
	    $fullName = $_POST["fullName"];
	    $username = $_POST["usernameReg"];
	    $email = $_POST["emailReg"];
			// encrypt password
	    $password = password_hash($_POST["passwordReg"], PASSWORD_BCRYPT);

	    // call function to check if email or username already is registred
	    $result = checkEmailAndUsername($db, $email, $username);

	    if ($result ==  EMAIL_ALREADY_REG) {
	      $_SESSION["error"] = "This email is already registered.";
	    } else if ($result ==  USERNAME_TAKEN)  {
				$_SESSION["error"] = "This username is already taken, pick another one.";
			} else {
	    // store new user data in database
			$insertUserIntoDb = "INSERT INTO users (name, username, email, password)
			VALUES (:name, :username, :email, :password)";

			$insertUserStatement = $db->prepare($insertUserIntoDb);
			$insertUserStatement->execute([
				":name" => $fullName,
				":username" => $username,
				":email" => $email,
				":password" => $password,
			]);
			// put user info in session to login user
			$id = $db->lastInsertId();
			$_SESSION["login"]["id"] = $id;
			$_SESSION["login"]["username"] = $_POST["usernameReg"];
	    }
	  }
		header("Location: /");
	  exit();
	}
}
