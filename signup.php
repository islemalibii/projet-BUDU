<?php

if (empty($_POST["username"])) {
    die("Username is required");
}
if (empty($_POST["email"])) {
    die("Email is required");
}
if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("A correct email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("8 characters are required for the password");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ($_POST["password"] !== $_POST["repassword"]) {
    die("Password must be the same");
}

// hash = password_hash($password, PASSWORD_DEFAULT);

$pdo = require __DIR__ . "/database.php";

$username = trim($_POST["username"]);
$email = trim($_POST["email"]);
$password = trim($_POST["password"]);


$userrr = 'user_' . $username;
$create_db = "CREATE DATABASE $userrr";

try {
    
    $main_db_host = 'localhost';
    $main_db_user = 'root';
    $main_db_pass = '';
    $main_db_name = 'BUDU';


    $conn = new PDO("mysql:host=$main_db_host;dbname=$main_db_name", $main_db_user, $main_db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $password);
    $stmt->execute();

    header("Location: register.html");
    
    exit;
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>