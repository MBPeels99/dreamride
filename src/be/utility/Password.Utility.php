<?php
	class PasswordUtils {
		// Verify a password against a hashed password
		public static function verifyPassword($password, $hashedPassword) {
			return ($password === $hashedPassword);
		}
		
		
		// Hash a password
		public static function hashPassword($password) {
			return hash('sha512', $password);
		}
	}

?>