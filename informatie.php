<?php
include 'database.php';
session_start();


if (!isset($_SESSION['LoggedInUser'])) {
    header('Location: login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['logout']) {
    $_SESSION['LoggedInUser'] = null;
    header('Location: login.php');
    die;
}
$bestemmingenQuery = $pdo->prepare('SELECT * FROM `bestemmingen` WHERE id = :id');

$id = $_GET['id'];

$bestemmingenQuery->bindParam('id', $id);

$bestemmingenQuery->execute();

$bestemmingen  = $bestemmingenQuery->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="logo2.png" type="image/x-icon">
    <title>SunTurk.com</title></head>
    <style>
.info {
    width: 90%;
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);    
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
}
.foto {
    width: 400px; 
    height:250px;
    margin-top: 25px;
}
.info2 {
    margin-left: 7%;
    margin-right: 7%;
    margin-top: 3%;
    margin-bottom: 2%;
}
a:visited, a:link, .terug {
    text-align: left;
    text-decoration: none;
    color: black;
}
    </style>
    <body>
        <div class="info">
            <div class="terug">
                <a href="index.php">↺ Terug</a>
            </div>
            <div>
            <?php foreach ($bestemmingen as $row) : ?>
                <div>
                    <img class="foto" src="<?= htmlspecialchars($row['foto']) ?>" alt="Foto van bestemming">
                    <h1 class="plaats"><?= htmlspecialchars($row['plaats']) ?></h1>
                    <h2><?= htmlspecialchars($row['stad']) ?></h2>
                    <h2>Activiteiten:</h2   >
                    <h3>-<?= htmlspecialchars($row['activiteit1']) ?></h3>
                    <h3>-<?= htmlspecialchars($row['activiteit2']) ?></h3>
                    <h3>-<?= htmlspecialchars($row['activiteit3']) ?></h3>
                    <h3 class="info2"><?= htmlspecialchars($row['informatie']) ?></h3>
                    <p>Hotel dichtbij: <?= htmlspecialchars($row['hotel']) ?></p>
                    <p>Restaurant dichtbij: <?= htmlspecialchars($row['restaurant']) ?></p>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
</body>
</html>