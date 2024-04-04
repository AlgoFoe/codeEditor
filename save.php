<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    header("location: /webpage/login_sys/login.php");
    exit;
}

$loggedin = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"]; 
    $htmlContent = $_POST['html'];
    $cssContent = $_POST['css'];
    $jsContent = $_POST['js'];
    
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "signup";
    
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "REPLACE INTO code (username, html_content, css_content, js_content) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $htmlContent, $cssContent, $jsContent);
    
    if ($stmt->execute()) {
        echo "Content saved successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
}
?>
