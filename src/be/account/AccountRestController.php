<?php
require_once("AccountRestHandler.php");

$page_key = "";
if(isset($_GET["page_key"]))
    $page_key = $_GET["page_key"];
/*
controls the RESTful services
URL mapping
*/
switch($page_key){

    case "all":
        // to handle REST Url /account/list/
        $accountRestHandler = new AccountRestHandler();
        $accountRestHandler->getAllAccounts();
        break;
        
    case "single":
        // to handle REST Url /account/show/<id>/
        $accountRestHandler = new AccountRestHandler();
        $accountRestHandler->getAccount($_GET["id"]);
        break;

    case "create":    
        $accountRestHandler = new AccountRestHandler();
        $accountRestHandler->addAccount();
        break;

    case "delete":    
        $accountRestHandler = new AccountRestHandler();
        $accountRestHandler->deleteAccount($_GET["id"]);
        break;    

    case "update":
        $accountRestHandler = new AccountRestHandler();
        $accountRestHandler->updateAccount($_GET["id"]);
        break; 
    case "session":
        session_start();
        $accountRestHandler = new AccountRestHandler();
        $accountRestHandler->getCurrentSesssion();
    case "" :
        //404 - not found;
        break;
    default:
        echo " default test pagekey";
        break;
}
?>
