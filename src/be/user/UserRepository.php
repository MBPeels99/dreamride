<?php

require_once("../SQL.php");
require_once("../modelclasses/User.class.php");

class UserRepository {
    private $sql;

    public function __construct(SQL $sql) {
        $this->sql = $sql;
    }

    // Retrieve a user by ID
    public function getUser($id) {
        $result = $this->sql->select('users', '*', "id = '$id'");
        return count($result) > 0 ? $this->createUserObject($result[0]) : null;
    }


	// Convert data array to User object
	private function createUserObject($data) {
		$user = new User(
			$data['id'],
			$data['first_name'],
			$data['last_name'],
            $data['date_of_birth'],
			$data['password'],
			$data['country'],
            $data['language'],
            $data['username'],
			$data['bio'],
			$data['profile_picture'],
            $data["parent_account_id"]
		);
		return $user;
	}


    // Create a new user
    public function createUser($user) {
        $data = [
            'first_name' => $user->get_first_name(),
            'last_name' => $user->get_last_name(),
            'username' => $user->get_user_name(),
            'password' => $user->get_password(),
            'date_of_birth' => $user->get_date_of_birth(),
            'country' => $user->get_country(),
            'language' => $user->get_language(),
            'bio' => $user->get_bio(),
            'profile_picture' => $user->get_profile_picture(),
            'parent_account_id' => $user->get_parent_id()
        ];
        return $this->sql->insert('users', $data);
    }

    // Update user details
    public function updateUser($id, $user) {
        $data = [
            'first_name' => $user->get_first_name(),
            'last_name' => $user->get_last_name(),
            'username' => $user->get_user_name(),
            'password' => $user->get_password(),
            'country' => $user->get_country(),
            'bio' => $user->get_bio(),
            'profile_picture' => $user->get_profile_picture()
        ];
        return $this->sql->update('users', $data, "id = '$id'");
    }

    // Delete a user
    public function deleteUser($id) {
        return $this->sql->delete('users', "id = '$id'");
    }

    //Delete user based on account_id
    public function deleteLinkedUser($id){
        return $this->sql->delete('users', "parent_account_id = '$id'");
    }
    
    // Get user email from database for validation
    //TODO: Might remove
    public function getUserByEmail($email) {
        $result = $this->sql->select('users', '*', "email = '$email'");
        return count($result) > 0 ? $this->createUserObject($result[0]) : null;
    }

    // Get user username from database for validaiton
    public function getUserByUsername($username) {
        $result = $this->sql->select('users', '*', "username = '$username'");
        return count($result) > 0 ? $this->createUserObject($result[0]) : null;
    }

    // Retrieve a user by username or email
    //TODO: Might remove
	public function getUserByUsernameOrEmail($usernameOrEmail) {
        $result = $this->sql->select('users', '*', "username = '$usernameOrEmail' OR email = '$usernameOrEmail'");
        return count($result) > 0 ? $this->createUserObject($result[0]) : null;
    }
	
	// Retrieve all users and return as an array of User objects
    public function getAllUsers() {
        $result = $this->sql->select('users');
        $users = [];
        foreach ($result as $userData) {
            $users[] = $this->createUserObject($userData);
        }
        return $users;
    }
}

?>
