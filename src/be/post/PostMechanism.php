<?php
require_once '..\modelclasses\Post.class.php';
require_once '..\DatabaseConnection.php';
require_once 'PostRepository.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];

    // Use current date and time as the date_posted
    $date_posted = date('Y-m-d H:i:s');

    // Create a new BlogPost object
    $post = new Post(null, $title, $content, $author_id, $date_posted, $category_id);

    // Now you can save this blog post object to your database
    // For this, you need to create a BlogPostRepository similar to your UsersRepository
    $dbConnection = new DatabaseConnection();
    $pdo = $dbConnection->getConnection();
    $sql = new SQL($pdo);
    $postRepository = new PostRepository($sql);
    $postRepository->createPost($post);

    //TODO: Edit this part for actual purpose of application
    // Redirect user to a specific page after successfully creating the blog post
    header('Location: successPage.php');
    exit;
}
?>
