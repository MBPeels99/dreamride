<?php

class Category implements JsonSerializable {
    private $id;
    private $name;
    private $description;

    public function __construct($id, $name, $description) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_name() {
        return $this->name;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_field_names(){
        return get_class_vars(get_class());
    }

    public function jsonSerialize(){
        return array(
            "id"            => $this->id,
            "name"          => $this->name,
            "description"   => $this->description
        );
    }
}

?>