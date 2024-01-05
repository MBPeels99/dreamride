<?php
require_once("../SimpleRest.php");
require_once("../modelclasses/Post.class.php");
require_once("PostRepository.php");
require_once("../DatabaseConnection.php");

class PostRestHandler extends SimpleRest {
    private $postRepository;

    public function __construct(){
        $this->postRepository = new PostRepository(new SQL(new DatabaseConnection()));
    }

    public function getAllPosts(){
        $posts = $this->postRepository->getRecentPosts(10);

        if (empty($posts)) {
            $statusCode = 404;
            $posts = array('error' => 'No blog posts found!');
        } else {
            $statusCode = 200;
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);

        echo json_encode($posts);
    }

    public function getPost($id) {
        $post = $this->postRepository->getPostByBlogPostID($id);

        if (empty($post)) {
            $statusCode = 404;
            $post = array('error' => 'Blog post not found!');
        } else {
            $statusCode = 200;
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        echo json_encode($post);
    }

    public function addPost() {
        $newpost = $this->checkPostInput();

        if (empty($newpost)) {
            $statusCode = 400;
            $returnValue = array('success' => 'false');
        } else {
            $this->postRepository->createPost($newpost);
            $statusCode = 201;
            $returnValue = array('success' => 'true');
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        echo json_encode($returnValue);
    }

    public function deletePost($id) {
        if (!isset($id)) {
            $statusCode = 404;
            $returnValue = array('success' => 'false');
        } else {
            $this->postRepository->deletePost($id);
            $statusCode = 200;
            $returnValue = array('success' => 'true');
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        echo json_encode($returnValue);
    }

    public function updatePost($id) {
        $newPost = $this->checkPostInput();

        if (empty($newPost) || !isset($id)) {
            $statusCode = 400;
            $returnValue = array('success' => 'false');
        } else {
            $this->postRepository->updatePost($newPost);
            $statusCode = 200;
            $returnValue = $newPost;
        }

        $requestContentType = $_SERVER['HTTP_ACCEPT'];
        $this->setHttpHeaders($requestContentType, $statusCode);
        echo json_encode($returnValue);
    }

    private function checkPostInput() {
        $userInput = json_decode(file_get_contents('php://input'), true);
        if (isset($userInput['title']) && isset($userInput['parent_id']) && isset($userInput['author_id']) && isset($userInput['date_posted']) && isset($userInput['category_id'])) {
            return new Post(
                0,
                $userInput['title'],
                $userInput['author_id'],
                $userInput['date_posted'],
                $userInput['category_id'],
                $userInput['parent_id']
            );
        }
        return null;
    }
}
?>
