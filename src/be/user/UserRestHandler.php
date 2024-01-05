<?php
    require_once("../SimpleRest.php");
    require_once("../modelclasses/User.class.php");
    require_once("UserRepository.php");
    require_once("../DatabaseConnection.php");
    require_once("../utility/RegexInputCheck.class.php");
    //require_once("LoginUtils.php");


    class UserRestHandler extends SimpleRest {
        private $userRepository;
        public function __construct(){
            $this->userRepository = new UserRepository(new SQL(new DatabaseConnection()));
        }

        public function getAllUsers(){
            $users = $this->userRepository->getAllUsers();
            if(empty($users)) {
                $statusCode = 404;
                $users = array('error' => 'User not found!');		
            } else {
                $statusCode = 200;
            }

            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);

            echo json_encode($users);
        }
        public function getUser($id) {

            $user = $this->userRepository->getUser($id);
    
            if(empty($user)) {
                $statusCode = 404;
                $user = array('error' => 'User not found!');		
            } else {
                $statusCode = 200;
            }

            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);

            echo json_encode($user);
        }

        public function addUser(){         
            $newUser = $this->checkUserInput();
            if(empty($newUser)){
                $statusCode = 404;
                $returnValue = array('success' => 'false');	
            } else {            
                $this->userRepository->createUser($newUser);
                $statusCode = 200;
                $returnValue = array('success' => 'true');
            }
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);

            echo json_encode($returnValue);
            
        }
        public function deleteUser($id){
            if(!isset($id)){
                $statusCode = 404;
                $returnValue = array('success' => 'false');
            }else {
                $this->userRepository->deleteUser($id);
                $statusCode = 200;
                $returnValue = array('success' => 'true');
            }
            
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            echo json_encode($returnValue);
        }

        public function updateUser($id){
            $newUser = $this->checkUserInput();
            if(empty($newUser) && (!isset($id))){
                $statusCode = 404;
                $returnValue = array('success' => 'false');	
            } else {          
                $this->userRepository->updateUser($id, $newUser);
                $statusCode = 200;
                $returnValue = array('success' => 'true');
            }
            $requestContentType = $_SERVER['HTTP_ACCEPT'];
            $this ->setHttpHeaders($requestContentType, $statusCode);
            echo json_encode($returnValue);
        }

        public function getCurrentSesssion(){
            $json = json_encode($_SESSION['current_user']);
            if ($json === false) {
                echo 'JSON encoding error: ' . json_last_error_msg();
            } else {
                echo $json;
            }
        }
        //Uses RegexInputCheck to check userinput, checks if json contains the right keys and also checks the input values to regexes found in RegexInputCheck for each individual field
        private function checkUserInput(){
            $userInput = json_decode(file_get_contents('php://input'), true);
            //TODO: Fix this part in Regex
            //if(RegexInputCheck::checkUserInputRegex("User", $userInput)){
                $userInput['password'] = hash('sha512', $userInput['password']);
                return $this->createUserObject($userInput);
            //}
            //return null;
        }
        //converts JSON to php User object
        private function createUserObject($data) {
            $user = new User(
                0,
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
    }
?>