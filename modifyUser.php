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
        $stmt = $conn->prepare("SELECT * FROM user WHERE idUser = :idUser");
        $stmt->bindParam(':idUser', $id);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "User ID not found.";
            exit();
        }
    } else {
        echo "User ID not provided.";
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['idUser'])) {
        $id = $_POST['idUser'];
        $username = $_POST["username"];
        $email = $_POST["email"];

        $stmt = $conn->prepare("UPDATE user SET username = :username, email = :email WHERE idUser = :idUser");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':idUser', $id);

        if ($stmt->execute()) {
            echo "Modification successful";
            header("Location: admin.php");
            exit();
        } else {
            echo "Modification failed";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify User</title>
    <link rel="stylesheet" href="Sched.css">
</head>
<body>

<h1>Modify User</h1>

<form method="POST" action="">
    <label for="idUser">ID :</label><br>
    <input type="text" id="idUser" name="idUser"  value="<?php echo $row['idUser']; ?>" readonly><br>
    <label for="username">Username :</label><br>
    <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"><br>
    <label for="email">E-mail :</label><br>
    <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>"><br>
    <button type="submit">Modify</button>
</form>

</body>
</html>


