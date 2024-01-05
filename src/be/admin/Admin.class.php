<?php 
    require_once("Account.class.php");
    
    class Admin extends Account{
        protected $is_super_admin;

        public function __construct($id, $first_name, $last_name, $email, $password, $is_super_admin){
            parent::__construct($id, $first_name, $last_name, $email, null, $password, null, null);
            $this->is_super_admin = $is_super_admin;
        }

        public function get_is_super_admin(){
            return $this->is_super_admin;
        }

        public function jsonSerialize(){
            return array_merge(parent::jsonSerialize(), array(
                "is_super_admin" => $this->is_super_admin
            ));
        }
    }
?>
