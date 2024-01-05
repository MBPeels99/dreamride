<?php
// Include the required files
require_once '../user/UserRepository.php';
require_once '../account/AccountRepository.php';
require_once '../utility/Password.Utility.php';
require_once '../DatabaseConnection.php';

// Establish a database connection using the DatabaseConnection class
$dbConnection = new DatabaseConnection();
$pdo = $dbConnection;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if($_POST["btn_login"]){
		
		$usernameOrEmail = trim($_POST['username']);
		$password = hash('sha512', $_POST['password']);
		validateLogin($usernameOrEmail, $password, $pdo);
	}
}

// Function to validate the login
function validateLogin($usernameOrEmail, $password, $pdo) {	
	if ($_POST['login-form'] == "parent"){
		$repository =  new AccountRepository(new SQL($pdo));
		$account = $repository->getAccountByEmail($usernameOrEmail);
		if ($account) {
			// User found
			// validate the password
			if(PasswordUtils::verifyPassword($password, $account->get_password())){
				createAccountSession($account);
				header('Location: ../../app/profile.html');
				exit;
			}
		}
	} else if($_POST['login-form'] == "child"){
		$repository =  new UserRepository(new SQL($pdo));
		$user = $repository->getUserByUsername($usernameOrEmail);
		if ($user) {
			// User found
			// validate the password
			if(PasswordUtils::verifyPassword($password, $user->get_password())){
				createUserSession($user);
				header('Location: ../../app/profile_child.html');
				exit;
			}
		}
	}
    // Login failed
	header('Location: ../../app/loginsignup.html');
	exit;
}

function createAccountSession($account){
	session_start();
	$_SESSION = [];
	$_SESSION['current_account'] = $account;
}
function createUserSession($user){
	session_start();
	$_SESSION = [];
	$_SESSION['current_user'] = $user;
}

?>