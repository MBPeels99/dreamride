<?php

class TranslationPost extends Post implements JsonSerializable {
    private $language;
    private $translationTitle;
    private $translationContent;

    public function __construct($id, $title, $author_id, $date_posted, $category_id, $parent_id, $language, $translationTitle, $translationContent) {
        parent::__construct($id, $title, $author_id, $date_posted, $category_id, $parent_id);
        $this->language = $language;
        $this->translationTitle = $translationTitle;
        $this->translationContent = $translationContent;
    }

    public function get_language() {
        return $this->language;
    }

    public function get_translation_title() {
        return $this->translationTitle;
    }

    public function get_translation_content() {
        return $this->translationContent;
    }

    public function get_table_name() {
        return 'translation';
    }

    public function jsonSerialize() {
        return array_merge(parent::jsonSerialize(), array(
            "language" => $this->language,
            "title" => $this->translationTitle,
            "content" => $this->translationContent
        ));
    }
}
?>
