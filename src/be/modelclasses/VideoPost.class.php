<?php

class VideoPost implements JsonSerializable {
    private $id;
    private $videoUrl;
    private $postId;
    private $imageId;

    public function __construct($id, $videoUrl, $postId, $imageId) {
        $this->id = $id;
        $this->videoUrl = $videoUrl;
        $this->postId = $postId;
        $this->imageId = $imageId;
    }

    public function get_id() {
        return $this->id;
    }

    public function get_video_url() {
        return $this->videoUrl;
    }

    public function get_post_id() {
        return $this->postId;
    }

    public function get_image_id() {
        return $this->imageId;
    }

    public function get_table_name() {
        return 'video';
    }

    public function jsonSerialize() {
        return array(
            "id" => $this->id,
            "video_url" => $this->videoUrl,
            "post_id" => $this->postId,
            "image_id" => $this->imageId
        );
    }
}
?>
