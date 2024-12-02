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
        $stmt = $conn->prepare("DELETE FROM daily_schedule WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            header("Location: schedule.php");
            exit();

        } 
    } 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


$conn = null;
?>