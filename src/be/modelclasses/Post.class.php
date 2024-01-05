<?php

class Post {
    private $id;
    private $title;
    private $author_id;
    private $date_posted;
    private $category_id;
    private $parent_id;
    private $likes;

    public function __construct($id, $title, $author_id, $date_posted, $category_id, $parent_id) {
        $this->id = $id;
        $this->title = $title;
        $this->author_id = $author_id;
        $this->date_posted = $date_posted;
        $this->category_id = $category_id;
        $this->parent_id = $parent_id;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_title() {
        return $this->title;
    }

    public function get_author_id() {
        return $this->author_id;
    }

    public function get_date_posted() {
        return $this->date_posted;
    }

    public function get_category_id() {
        return $this->category_id;
    }

    public function get_parent_id() {
        return $this->parent_id;
    }

    public function get_likes() {
        return $this->likes;
    }

    public function set_likes($likes) {
        $this->likes = $likes;
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "author_id" => $this->author_id,
            "date_posted" => $this->date_posted,
            "category_id" => $this->category_id,
            "parent_id" => $this->parent_id
        ];
    }
}

?>
