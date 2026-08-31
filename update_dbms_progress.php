<?php
session_start();

$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'DB Connection Failed']));
}

if (!isset($_SESSION['register_number'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$topic_slug = $conn->real_escape_string($data['topic_slug']);
$checked = $data['checked']; // true or false
$reg_num = $_SESSION['register_number'];

if ($checked) {
    // Insert if checked
    $sql = "INSERT IGNORE INTO user_dbms_progress (register_number, topic_slug) VALUES ('$reg_num', '$topic_slug')";
} else {
    // Delete if unchecked
    $sql = "DELETE FROM user_dbms_progress WHERE register_number = '$reg_num' AND topic_slug = '$topic_slug'";
}

if ($conn->query($sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'error' => $conn->error]);
}
?>
