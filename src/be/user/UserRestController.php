<?php
require_once("UserRestHandler.php");
		
$page_key = "";
if(isset($_GET["page_key"]))
	$page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping
*/
switch($page_key){

	case "all":
		// to handle REST Url /user/list/
		$userRestHandler = new UserRestHandler();
		$userRestHandler->getAllUsers();
		break;
		
	case "single":
		// to handle REST Url /user/show/<id>/
		$userRestHandler = new UserRestHandler();
		$userRestHandler->getUser($_GET["id"]);
		break;

    case "create":    
        $userRestHandler = new UserRestHandler();
        $userRestHandler->addUser();
        break;

    case "delete":    
        $userRestHandler = new UserRestHandler();
        $userRestHandler->deleteUser($_GET["id"]);
        break;    

    case "update":
        $userRestHandler = new UserRestHandler();
        $userRestHandler->updateUser($_GET["id"]);
        break; 
	case "session":
		session_start();
		$userRestHandler = new UserRestHandler();
		$userRestHandler->getCurrentSesssion();
	case "" :
		//404 - not found;
		break;
}

?>