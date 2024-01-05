<?php 
    require_once("Account.class.php");
    class User extends Account implements JsonSerializable{
        private $user_name;
        private $bio;
        private $profile_picture;
        private $parent_id;


        public function __construct($id, $first_name, $last_name, $date_of_birth, $password, $country, $language, $user_name, $bio, $profile_picture, $parent_id){
            parent::__construct($id, $first_name, $last_name, "", $date_of_birth, $password, $country, $language,0);
            $this->date_of_birth = $date_of_birth;
            $this->user_name = $user_name;
            $this->bio = $bio;
            $this->profile_picture = $profile_picture;
            $this->parent_id = $parent_id;
        }
        public function get_user_name(){
            return $this->user_name;
        }
        public function get_bio(){
            return $this->bio;
        }
        public function get_profile_picture() {
            return $this->profile_picture;
        }
        public function get_parent_id(){
            return $this->parent_id;
        }

        public function get_field_names(){
            return get_class_vars(get_class());
        }
        //overrides standard Json Serialize behaviour
        public function jsonSerialize(){
            return array(
                "id"                => $this->id,
                "first_name"        => $this->first_name,
                "last_name"         => $this->last_name,
                "username"         => $this->user_name,
                "date_of_birth"     => $this->date_of_birth,
                "country"           => $this->country,
                "language"          => $this->language,
                "bio"               => $this->bio,
                "profile_picture"   => $this->profile_picture,
                "parent_account_id" => $this->parent_id
            );
        }
    }
?>