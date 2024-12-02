<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule</title>
  <link rel="stylesheet" href="Sched.css">
  <style>
        .btn{
            background-color: #62935c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Open Sans", sans-serif;
            margin-top: 20px;
            margin-left: 50px;
        }
    </style>
</head>
<body>
    <header>
        <a href="index1.php"><button class="btn" type="button">HOME</button></a>
    </header>
<div> <button class="head" type='submit' onclick="location.href='createsched.php'">Create</button> </div>
  <center>
  <h1 class="nosched">Schedules</h1>
  </center>
  
  <?php

  $dbhost = 'localhost';  
  $username = 'root';
  $password = '';
  $dbname = 'BUDU';


  try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM daily_schedule");
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      echo "<div class='schedule'>";
      echo "<div class='column'><strong>ID</strong></div>";
      echo "<div class='column'><strong>Day</strong></div>";
      echo "<div class='column'><strong>Activity</strong></div>";
      echo "<div class='column'><strong>Allocated Hours</strong></div>";
      echo "<div ></div>";
      echo "<div ></div>";

      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='column'>" . $row["id"] . "</div>";
        echo "<div class='column'>" . $row["day"] . "</div>";
        echo "<div class='column'>" . $row["activity"] . "</div>";
        echo "<div class='column'>" . $row["allocatedHours"] . "</div>" ;
        echo "<div> <button type='submit' onclick='location.href=`Modifysched.php?id=" .$row["id"] ."`'>Modify</button> </div>";
        echo "<div> <button type='submit' onclick='location.href=`delete.php?id=" .$row["id"] ."`'>Delete</button> </div>";

      }
      echo "</div>";

    } else {

      echo "<center> <p class='nosched'> No schedules found. </p> <br> </center>";
      echo"<center> <button class='nosched' type='submit' onclick='location.href=`createsched.php`'>Back to Create Schedule</button> </center>";
    }
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }

  $conn = null;
  ?>

  
</body>
</html>