<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $username = htmlspecialchars($_POST['username']);
    $wachtwoord = htmlspecialchars($_POST['wachtwoord']);

    $sql = "INSERT INTO gebruikers (username, wachtwoord) 
            VALUES (:username, :wachtwoord)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':wachtwoord' => $wachtwoord,
    ]);
    header("Location: login.php ");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="logo2.png" type="image/x-icon">
        <title>
            SunTurk.com
        </title>
        <style>
div {
    height: 500px;
    width: 400px;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);    
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    }
input {
    height: 50px;
    width: 300px;
    margin: 25px;
    border: 2px solid;
}
input:focus {
    border:3px solid  #FFA500;
    outline: none;
}
.aanmelden {
    margin-top: 50px;
}
.terug {
    display: block;
    text-align: left;
    margin-left: 15px;
    margin-top: 15px;
}
.logo {
    height: 200px;
    width: 200px;
    position: absolute;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
        </style>
    </head>
    <body>
        <table>
            <td><img class=logo src="logo1.png" height="60"></td>
        </table>
        <div>
            <a class= terug href="login.php">↺ Terug</a>
            <p class= aanmelden>Aanmelden</p>
            <form method="POST" action="">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="wachtwoord" placeholder="Wachtwoord">
            <input type="submit" value="Aanmelden">
            </form>
        </div>
    </body>
</html>