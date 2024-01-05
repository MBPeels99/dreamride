<?php
    require_once "..\database\DatabaseConnection.php";
    require_once "..\database\SQL.php";
    
    // Create a new instance of DatabaseConnection
    $databaseConnection = new DatabaseConnection();
    
    // Get the database connection object
    $pdo = $databaseConnection->getConnection();
    
    // Create a new instance of SQL
    $sql = new SQL($pdo);
    
    // Example usage: Select query
    $result = $sql->select("account","*", "id =  '645e45558ac1b'");
    print_r($result);
    
    //Example usage: Delete query
    $result = $sql->delete("account","id = '600221b1-3d14-43e4-b745-9362aff77b3e'");
    print_r($result);

    // Example usage: Insert query
    $data = array(
        "first_name" => "Megan",
        "last_name" => "Fourie",
        "email" => "john.doe@gmail.com"
    );
    $rowAffected = $sql->insert("account", $data);
    echo "Rows affected: " . $rowAffected;
    
?>