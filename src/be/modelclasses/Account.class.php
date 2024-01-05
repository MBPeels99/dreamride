<?php 
    class Account implements JsonSerializable{
        protected $id; 
        protected $first_name;
        protected $last_name;
        protected $date_of_birth;
        protected $country;
        protected $language;
        private $email;
        protected $password;
        protected $message_amount;

        public function __construct($id, $first_name, $last_name, $email, $date_of_birth, $password, $country, $language, $message_amount){
            $this->id               = $id;
            $this->first_name       = $first_name;
            $this->last_name        = $last_name;
            $this->email            = $email;
            $this->date_of_birth    = $date_of_birth;
            $this->password         = $password;
            $this->country          = $country;
            $this->language         = $language;
            $this->message_amount   = $message_amount;
        }

        public function get_id(){
            return $this->id;
        }
        public function get_first_name(){
            return $this->first_name;
        }
        public function get_last_name(){
            return $this->last_name;
        }
        public function get_email(){
            return $this->email;
        }
        public function get_password(){
            return $this->password;
        }
        public function get_date_of_birth(){
            return $this->date_of_birth;
        }
        public function get_country(){
            return $this->country;
        }
        public function get_language(){
            return $this->language;
        }
        public function get_message_amount(){
            return $this->message_amount;
        }

        public function jsonSerialize(){
            return array(
                "id"                => $this->id,
                "first_name"        => $this->first_name,
                "last_name"         => $this->last_name,
                "email"             => $this->email,
                "date_of_birth"     => $this->date_of_birth,
                "country"           => $this->country,
                "language"          => $this->language,
                "message_amount"    => $this->message_amount
            );
        }
    }
?>