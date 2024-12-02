<?php

if($_SERVER["REQUEST_METHOD"] === "POST"){

   
    require_once __DIR__ . "/database.php";

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $sql= "SELECT * FROM user WHERE email = :email";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        if($password === $user["password"]){
            session_start();
            session_regenerate_id();
            $_SESSION["idUser"]=$user["idUser"];
            if ($user["idUser"] === 1 ){
                header("Location: admin.php");
                exit;
            }else{
                header("Location: index1.php");
                exit;
            }
        }else {
            echo "INCORRECT PASSWORD !!!";
        }
    }else{
        echo "User doesn't exist !!!" ;
    }
}

?>

