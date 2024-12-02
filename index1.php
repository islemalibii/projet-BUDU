<?php
session_start();

if(isset($_SESSION["idUser"])){
    require_once __DIR__ . "/database.php";

    $sql="SELECT * FROM user WHERE idUser = :idUser";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idUser', $_SESSION["idUser"]);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Welcome</title>
    <style>
        body{
            background: url(pic.png);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .logout{
            background-color: #62935c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Open Sans", sans-serif;
            margin-left: 1400px;
        }
        h1{
            font-family: "Open Sans", sans-serif;
            color: #444444;
            font-size: 70px;
        }
        p{
            font-family: "Open Sans", sans-serif;
            color: #444444;
            font-size: 20px;
        }
        .todo{
            background-color: #62935c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Open Sans", sans-serif;
            margin-top: 100px;
            margin-left: 250px;
        }
        .sched{
            background-color: #62935c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Open Sans", sans-serif;
            margin-top: 100px;
            margin-left:350px;
        }
        .music{
            background-color: #62935c;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: "Open Sans", sans-serif;
            margin-top: 100px;
            margin-left: 300px;
        }
    </style>
</head>
<body>
    <button class="logout" type="button" onclick="location.href='logout.php'">LOG OUT</button>
    <center>
        <h1>Welcome To BUDU</h1>
        <?php if(isset($user)): ?>
            <p>Hello <?= htmlspecialchars($user["username"]) ?> </p>
        <?php endif ;  ?>
    </center>
    <button class="todo" type="button" onclick="location.href='todolist.html'">TO DO LIST</button>
    <button class="sched" type="button" onclick="location.href='schedule.php'">SCHEDULE</button>
    <button class="music" type="button" onclick="location.href='musicplayer.html'">MUSIC</button>

    
    
</body>
</html>