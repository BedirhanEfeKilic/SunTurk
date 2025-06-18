<?php
session_start();
$errorMessage = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database.php';

    $username = $_POST['username'];
    $password = $_POST['wachtwoord'];

    $query = "SELECT * FROM gebruikers WHERE `username` = :username";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if ($user && $user["wachtwoord"] === $password) {
        $_SESSION['LoggedInUser'] = $username;
        $_SESSION['UserID'] = $user['id']; 
        header('Location: ./');
        exit;
    } else {
        $errorMessage = "Invalide gebruikersnaam/wachtwoord combinatie";
    }
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
    border-radius: 2px;
}
input:focus {
    border:3px solid  #FFA500;
    outline: none;
}
.inlog {
    margin-top: 50px;
}
.error {
    color: red;
    font-weight: bold;
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
            <p class= inlog>Inloggen</p>
            <form method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="wachtwoord" placeholder="Wachtwoord">
            <input type="submit" value="Login">
            <p class=error><?php echo $errorMessage; ?></p>
            <p>Nog geen account?
            <a href="aanmelden.php">Aanmelden</a>
            </form>
        </div>
    </body>
</html>