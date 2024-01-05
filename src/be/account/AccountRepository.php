<?php

require_once("../SQL.php");
require_once("../modelclasses/Account.class.php");

class AccountRepository {
    private $sql;

    public function __construct(SQL $sql) {
        $this->sql = $sql;
    }

    // Retrieve an account by ID
    public function getAccount($id) {
        $result = $this->sql->select('account', '*', "id = '$id'");
        return count($result) > 0 ? $this->createAccountObject($result[0]) : null;
    }

    // Convert data array to Account object
    public function createAccountObject($data) {
        $account = new Account(
            $data['id'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['date_of_birth'],
            $data['password'],
            $data['country'],
            $data['language'],
            $data['message_amount']
        );
        return $account;
    }

    // Create a new account
    public function createAccount($account) {
        $data = [
            'first_name' => $account->get_first_name(),
            'last_name' => $account->get_last_name(),
            'email' => $account->get_email(),
            'password' =>  $account->get_password(),
            'date_of_birth' => $account->get_date_of_birth(),
            'country' => $account->get_country(),
            'language' => $account->get_language(),
            'message_amount' => $account->get_message_amount()
        ];
        return $this->sql->insert('account', $data);
    }

    // Update account details
    public function updateAccount($id, $account) {
        $data = [
            'first_name' => $account->get_first_name(),
            'last_name' => $account->get_last_name(),
            'email' => $account->get_email(),
            'password' => $account->get_password(),
            'date_of_birth' => $account->get_date_of_birth(),
            'country' => $account->get_country(),
            'language' => $account->get_language(),
            'message_amount' => $account->get_message_amount()
        ];
        return $this->sql->update('account', $data, "id = '$id'");
    }

    // Delete an account
    public function deleteAccount($id) {
        return $this->sql->delete('account', "id = '$id'");
    }

    // Get account email from database for validation
    public function getAccountByEmail($email) {
        $result = $this->sql->select('account', '*', "email = '$email'");
        return count($result) > 0 ? $this->createAccountObject($result[0]) : null;
    }

    // Retrieve all accounts and return as an array of Account objects
    public function getAllAccounts() {
        $result = $this->sql->select('account');
        $accounts = [];
        foreach ($result as $accountData) {
            $accounts[] = $this->createAccountObject($accountData);
        }
        return $accounts;
    }
}

?>
