<?php
// Include the required files
require_once '../account/AccountRepository.php';
require_once '../utility/Password.Utility.php';
require_once '../DatabaseConnection.php';

// Establish a database connection using the DatabaseConnection class
$dbConnection = new DatabaseConnection();
$pdo = $dbConnection;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_POST["btn_signup"]){
		// Gather data from form
		$firstName = $_POST['first_name'];
		$lastName = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$birthDate = $_POST['date_of_birth'];
		$country = $_POST['country'];
		$language = $_POST['language'];
	
		// Perform the signup validation
		if (validateSignup($firstName, $lastName, $email, $password, $birthDate, $country, $language, $pdo)) {
			// Signup successful, redirect to the home page or any other authorized page
			// TODO: Add the actual location for the "Profile"
			header('Location: ../../app/profile.html');
			exit;
		} else {
			// Signup failed, display an error message or redirect back to the signup form
			// TODO: Add the actual location for signup
			header('Location: ../../app/loginsignup.html');
			exit;
		}
	} else if($_POST["sign-in-btn"]) {
		header('Location: ../../app/loginsignup.html');
		exit;
	}
}

// Function to validate the signup
function validateSignup($firstName, $lastName, $email, $password, $birthDate, $country, $language, $pdo) {
    $AccountRepository = new AccountRepository(new SQL($pdo));

	if (preg_match('/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/i', $email)) {
		// Valid email address
		// Check if the email already exists
		$user = $AccountRepository->getAccountByEmail($email);
		if (!$user) {
			// User not found, proceed with the signup
			$hashedPassword = PasswordUtils::hashPassword($password);
			// Create user data array
			$userData = array(
				'user_id' => null,  // When inserting the User into DB the SQL will generate an ID
				'first_name' => $firstName,
				'last_name' => $lastName,
				'email' => $email,
				'date_of_birth' => $birthDate,
				'password' => $hashedPassword,
				'country' => $country,
				'language' => $language
			);

			// Convert the array to a User object
			$user = $AccountRepository->createAccountObject($userData);

			// Insert the new user into the database
			$AccountRepository->createAccount($user);
			createAccountSession($user);
			
			return true;
		} else {
			// Email already exists, return false
			echo "Email already exists."; //TODO: Need to remove in final product
			return false;
		}
	} else {
		// Not a valid email address
		echo "The string is not a valid email."; //TODO: Need to remove in final product
		return false;
	} 
}

function createAccountSession($account){
	session_start();
	$_SESSION = [];
	$_SESSION['current_account'] = $account;
}

?>
