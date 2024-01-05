<?php
    require_once("../SimpleRest.php");
    require_once("../modelclasses/Account.class.php");
    require_once("AccountRepository.php");
    require_once("../DatabaseConnection.php");
    require_once("../utility/RegexInputCheck.class.php");
    require_once("../user/UserRepository.php");


    class AccountRestHandler extends SimpleRest {
        private $accountsRepository;
        //uses RegexInputCheck to get an array containing keys are the required json object field names and values with the regex which should be tested for this field
        public function __construct(){
            $this->accountsRepository = new AccountRepository(new SQL(new DatabaseConnection()));
        }

        public function getAllAccounts(){
            $accounts = $this->accountsRepository->getAllAccounts();
    
            if(empty($accounts)) {
                $statusCode = 404;
                $accounts = array('error' => 'Account not found!');		
            } else {
                $statusCode = 200;
            }

            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);

            echo json_encode($accounts);
        }
        
        public function getAccount($id) {
            $account = $this->accountsRepository->getAccount($id);
    
            if(empty($account)) {
                $statusCode = 404;
                $account = array('error' => 'Account not found!');		
            } else {
                $statusCode = 200;
            }

            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            echo json_encode($account);
        }

        public function addAccount(){
            $newAccount = $this->checkUserInput();       
            if(empty($newAccount)){
                $statusCode = 404;
                $returnValue = array('success' => 'false');	
            } else {               
                $this->accountsRepository->createAccount($newAccount);
                $statusCode = 200;
                $returnValue = array('success' => 'true');
            }

            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);

            echo json_encode($returnValue);
        }
        
        public function deleteAccount($id){
            if(!isset($id)){
                $statusCode = 404;
                $returnValue = array('success' => 'false');
            }else {
                $userRepository = new UserRepository(new SQL(new DatabaseConnection()));
                $userRepository->deleteLinkedUser($id);
                $this->accountsRepository->deleteAccount($id);
                $statusCode = 200;
                $returnValue = array('success' => 'true');
            }
            
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            echo json_encode($returnValue);
        }

        public function updateAccount($id){
            $newAccount = $this->checkUserInput(); 
            if(empty($newAccount) && !isset($id)){
                $statusCode = 404;
                $returnValue = array('success' => 'false');	
            } else {           
                $this->accountsRepository->updateAccount($id, $newAccount);
                $statusCode = 200;
                $returnValue = $newAccount;
            }
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            echo json_encode($returnValue);
        }

        public function getCurrentSesssion(){
            // Check if the session data you want is set
            $json = json_encode($_SESSION['current_account']);
            if ($json === false) {
                echo 'JSON encoding error: ' . json_last_error_msg();
            } else {
                echo $json;
            }
        }

        //Uses RegexInputCheck to check userinput, checks if json contains the right keys and also checks the input values to regexes found in RegexInputCheck for each individual field
        private function checkUserInput(){
            $userInput = json_decode(file_get_contents('php://input'), true);
            if(RegexInputCheck::checkUserInputRegex("Account", $userInput)){
                $userInput['password'] = hash('sha512', $userInput['password']);
                return $this->createAccountObject($userInput);
            }
            return null;
        }
        private function createAccountObject($data) {
            $account = new Account(
                0,
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
    }
?>

