<?php 
class Database{
    private $conn;
    public function __construct(){
        $this->conn = new mysqli('sql110.infinityfree.com', 'if0_37144768', '19112004Ab', 'if0_37144768_fastlearn_db');
    }
    public function connect(){
        return $this->conn;
    }
    public function all($table){
        $stmt = $this->conn->prepare("SELECT * FROM $table");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function one($table, $id){
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function delete($table, $id){
        $stmt = $this->conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function getWhereTL($value){
        $stmt = $this->conn->prepare('SELECT * FROM traloiphanhoi WHERE id_phan_hoi = ? ORDER BY id DESC LIMIT 1');
        $stmt->bind_param('s', $value);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function oneWhere($table, $column, $value){
        $stmt = $this->conn->prepare("SELECT * FROM $table WHERE $column = ?");
        $stmt->bind_param('i', $value);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}