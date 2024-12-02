<?php

require_once __DIR__ . "/database.php";
$dbhost = "localhost";
$dbname = "BUDU";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM user WHERE idUser = :idUser");
        $stmt->bindParam(':idUser', $id);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            header("Location: admin.php");
            exit();

        } 
    } 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;
?>