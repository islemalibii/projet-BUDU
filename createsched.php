<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $day = $_POST['day'];
        $activity = $_POST['activity'];
        $allocatedHours = $_POST['allocatedHours'];

        require_once __DIR__ . "/database.php";
        $sql = "INSERT INTO daily_schedule (day, activity, allocatedHours) VALUES (?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(1, $day);
            $stmt->bindParam(2, $activity);
            $stmt->bindParam(3, $allocatedHours, PDO::PARAM_INT);
            $stmt->execute();
            header("Location: schedule.php");
            exit();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Form</title>
    <link rel="stylesheet" href="Sched.css">
</head>
<body>

<h1>Create Schedule</h1>
<form method="POST" >
    <label for="day">Day:</label><br>
    <input type="text" id="day" name="day" placeholder="Day" required><br>
    <label for="activity">Activity:</label><br>
    <input type="text" id="activity" name="activity" placeholder="Activity" required><br>
    <label for="allocatedHours">Allocated Hours:</label><br>
    <input type="text" id="allocatedHours" name="allocatedHours" placeholder="Allocated Hours" required><br>
    <button type="submit">Create</button>
</form>

</body>
</html>