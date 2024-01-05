<?php
require_once "DatabaseConnection.php";
class SQL {
    private $conn;

    public function __construct($pdo){
        $this->conn = $pdo->getConnection();
    }
    
    public function select($table, $columns = '*', $condition = '', $order = '', $limit = '') {
        $query = "SELECT $columns FROM $table";
        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }
        if (!empty($order)) {
            $query .= " ORDER BY $order";
        }
        if (!empty($limit)) {
            $query .= " LIMIT $limit";
        }
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function insert($table, $data) {
        $columns = implode(',', array_keys($data));
        $values = ':' . implode(',:', array_keys($data));                       //uniqid('', true) <- Possible use
        $stmt = $this->conn->prepare("INSERT INTO $table (id,$columns) VALUES ('".$this->UUIDGenerator()."',$values)");   
        foreach ($data as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function update($table, $data, $condition = '') {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key,";
        }
        $set = rtrim($set, ',');
        
        $query = "UPDATE $table SET $set";
        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }
        
        $stmt = $this->conn->prepare($query);
        foreach ($data as $key => &$value) {
            $stmt->bindParam(':' . $key, $value);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function delete($table, $condition = '') {
        $query = "DELETE FROM $table";
        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Count method for count queries
    public function count($table, $columns = '*', $condition = '') {
        $query = "SELECT COUNT($columns) AS count FROM $table";
        if (!empty($condition)) {
            $query .= " WHERE $condition";
        }
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }

    public function rawQuery($query){
        $stmt = $this->conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //Function from https://www.uuidgenerator.net/dev-corner/php. Creates UUID for id in database.
    function UUIDGenerator($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
?>
