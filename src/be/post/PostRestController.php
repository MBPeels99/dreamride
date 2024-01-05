<?php
require_once("PostRestHandler.php");

$page_key = "";
if (isset($_GET["page_key"])) {
    $page_key = $_GET["page_key"];
}

/*
Controls the RESTful services
URL mapping
*/
switch ($page_key) {
    case "all":
        // Handle REST Url /post/list/
        $PostRestHandler = new PostRestHandler();
        $PostRestHandler->getAllPosts();
        break;

    case "single":
        // Handle REST Url /post/show/<id>/
        $PostRestHandler = new PostRestHandler();
        $PostRestHandler->getPost($_GET["id"]);
        break;

    case "create":
        $PostRestHandler = new PostRestHandler();
        $PostRestHandler->addPost();
        break;

    case "delete":
        $PostRestHandler = new PostRestHandler();
        $PostRestHandler->deletePost($_GET["id"]);
        break;

    case "update":
        $PostRestHandler = new PostRestHandler();
        $PostRestHandler->updatePost($_GET["id"]);
        break;

    case "":
        // 404 - not found
        break;

    default:
        echo "Default test pagekey";
        break;
}
?>
