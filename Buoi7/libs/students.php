<?php
global $conn;

function connect_db()
{
    global $conn;
    
    if (!$conn){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=qlsinhvien", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("set names utf8");
        } catch (PDOException $e) {
            die("Can't not connect to database: " . $e->getMessage());
        }
    }
}

function disconnect_db()
{
    global $conn;
    
    if ($conn) {
        $conn = null;
    }
}

function get_all_students()
{
    global $conn;
    
    connect_db();
    
    $sql = "SELECT * FROM sinhvien";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}

function get_student($student_id)
{
    global $conn;
    
    connect_db();
    
    $sql = "SELECT * FROM sinhvien WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}

function add_student($student_name, $student_sex, $student_birthday)
{
    global $conn;
    
    connect_db();
    
    $sql = "INSERT INTO sinhvien (hoten, gioitinh, ngaysinh) VALUES (:hoten, :gioitinh, :ngaysinh)";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':hoten', $student_name);
    $stmt->bindParam(':gioitinh', $student_sex);
    $stmt->bindParam(':ngaysinh', $student_birthday);
    
    return $stmt->execute();
}

function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{
    global $conn;
    
    connect_db();
    
    $sql = "UPDATE sinhvien SET hoten = :hoten, gioitinh = :gioitinh, ngaysinh = :ngaysinh WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
    $stmt->bindParam(':hoten', $student_name);
    $stmt->bindParam(':gioitinh', $student_sex);
    $stmt->bindParam(':ngaysinh', $student_birthday);
    
    return $stmt->execute();
}

function delete_student($student_id)
{
    global $conn;
    
    connect_db();
    
    $sql = "DELETE FROM sinhvien WHERE id = :id";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':id', $student_id, PDO::PARAM_INT);
    
    return $stmt->execute();
}
?>
