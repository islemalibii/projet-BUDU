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
        $stmt = $conn->prepare("SELECT * FROM daily_schedule WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $day = $_POST["day"];
                $activity = $_POST["activity"];
                $allocatedHours = $_POST["allocatedHours"];


                $stmt = $conn->prepare("UPDATE daily_schedule SET day = :day, activity = :activity, allocatedHours = :allocatedHours WHERE id = :id");
                $stmt->bindParam(':day', $day);
                $stmt->bindParam(':activity', $activity);
                $stmt->bindParam(':allocatedHours', $allocatedHours);
                $stmt->bindParam(':id', $id);
                
                if ($stmt->execute()) {
                    echo "Modification successful";
                    header("Location: schedule.php");
                    exit();
                } else {
                    echo "Modification failed";
                }
            }
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
    <title>Modify Schedule Form</title>
    <link rel="stylesheet" href="Sched.css">
</head>
<body>

<h1>Modify Schedule</h1>

<form method="POST" action="">
    <label for="day">Day:</label><br>
    <input type="text" id="day" name="day" value="<?php echo $row['day']; ?>"><br>
    <label for="activity">Activity:</label><br>
    <input type="text" id="activity" name="activity" value="<?php echo $row['activity']; ?>"><br>
    <label for="allocatedHours">Allocated Hours:</label><br>
    <input type="text" id="allocatedHours" name="allocatedHours" value="<?php echo $row['allocatedHours']; ?>"><br>
    <button type="submit">Modify</button>
</form>

</body>
</html>
