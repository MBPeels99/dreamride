<?php

class StoryPost extends Post implements JsonSerializable {
    private $content1;
    private $content2;

    public function __construct($id, $title, $author_id, $date_posted, $category_id, $parent_id, $content1, $content2) {
        parent::__construct($id, $title, $author_id, $date_posted, $category_id, $parent_id);
        $this->content1 = $content1;
        $this->content2 = $content2;
    }

    public function get_content1() {
        return $this->content1;
    }

    public function get_content2() {
        return $this->content2;
    }

    public function get_table_name() {
        return 'story';
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), array(
            "content_1" => $this->content1,
            "content_2" => $this->content2
        ));
    }
}
?>
