<?php
    //class contains arrays for specific model classes on which the incoming json object are tested.
    //arrays consist of keys and values, keys of the arrays must match the keys of the incoming json object.
    //the values of the arrays contain the regular expressions by which the incoming userdata is tested. 
    class regexInputCheck {
        //Testing array for the model class User.class.php
        private $userRegex = array(
            "first_name"        => "/.+/",
            "last_name"         => "/.+/",
            "username"          => "/.+/",
            "password"          => "/.+/",
            "date_of_birth"     => "/.+/",
            "country"           => "/.+/",
            "language"          => "/.+/",
            "bio"               => "/.+/",
            "profile_picture"   => "/.+/",
            "parent_account_id" => "/.+/"
        );
        //Testing array for the model class Account.class.php
        private $accountRegex = array (
            'first_name'        => "/.+/",
            'last_name'         => "/.+/",
            'email'             => "/.+/",
            'date_of_birth'     => "/.+/",
            'password'          => "/.+/",
            'country'           => "/.+/",
            'language'          => "/.+/"
        );
        //This static method creates a new instance of this class which it then uses to check the incoming user data.
        //Check is done by looping through the class array for the specified model class. Class array value is the regex used to check input data.
        //Class array key is used to get the value of the json object which has to be checked. 
        //If json does not contain all keys or has different key values the method returns false
        //$modelClass is used as case for the switch statement, adding new model classes can be done by extending the switch with more cases.
        public static function checkUserInputRegex($modelClass, $userInput) {
            $temp = new regexInputCheck();
            switch($modelClass){
                case "User":
                    foreach($temp->userRegex as $key => $value){
                        if(preg_match($value, $userInput[$key] ?? null) == 0){
                            return false;
                        }
                    }
                    return true;
                case "Account":
                    foreach($temp->accountRegex as $key => $value){
                        if(preg_match($value, $userInput[$key] ?? null) == 0){
                            return false;
                        }
                    }
                    return true;
            }
            return false;
        }
    }
?>