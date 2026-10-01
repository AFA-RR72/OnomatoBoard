<?php require_once(__DIR__ . '/../config/conexao.php');

function create_user($name, $email, $password)
{
    $conn = conn();

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $password);
    $stmt->execute();
    $stmt->close();

    return;
}

function get_user_by_email($email) {
    $conn = conn();

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt -> bind_param('s', $email);
    $stmt->execute();

    $result = $stmt ->get_result()->fetch_assoc();

    return $result;
}

function get_user_by_id($id) {
    $conn = conn();

    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt -> bind_param('i', $id);
    $stmt->execute();

    $result = $stmt ->get_result()->fetch_assoc();

    return $result;
}

function check_email($email){
    $conn = conn();

    $stmt = $conn -> prepare("SELECT * FROM users WHERE email = ?");
    $stmt -> bind_param("s", $email);

    $stmt -> execute();

    $result = $stmt -> get_result();
    if($result -> num_rows > 0){
        $stmt -> close();
        return true;
    }else{
        $stmt -> close();
        return false;
    }
}

function get_users(){
    $conn = conn();

    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();

    $result = $stmt ->get_result()->fetch_all(MYSQLI_ASSOC);

    return $result;
}

