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

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== '') {
$stmt = $pdo->prepare("SELECT * FROM bestemmingen 
    WHERE plaats LIKE :plaats 
    OR stad LIKE :stad 
    OR activiteit1 LIKE :activiteit1 
    OR activiteit2 LIKE :activiteit2 
    OR activiteit3 LIKE :activiteit3"
);

$stmt->execute([
    'plaats' => "%$search%",
    'stad' => "%$search%",
    'activiteit1' => "%$search%",
    'activiteit2' => "%$search%",
    'activiteit3' => "%$search%",
]);
    $bestemmingen = $stmt;
} else {
    $bestemmingenQuery = "SELECT * FROM bestemmingen";
    $bestemmingen = $pdo->query($bestemmingenQuery);
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="logo2.png" type="image/x-icon">
    <title>SunTurk.com</title>
   <style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 300px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
}

.sidebar h1 {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar h1.active {
  background-color:rgb(0, 0, 0);
  color: white;
  margin: 0;
}

div.content {
  margin-left: 300px;
  padding: 1px 16px;
  padding-top: 20px;
  border-radius: 30px
}

.images {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  row-gap: 20px;
  border-radius: 30px

}

.img {
  width: 30%;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  padding: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
  border-radius: 10px
}

.plaats {
  text-align: center;
  margin: 5;
  border-radius: 30px
}

.stad {
  text-align: center;
  margin: 0;
  margin-bottom: 10px
}

.activiteit {
  margin: 5px;
  text-align: left;
}

.img img {
  border-radius: 10px;
    margin-top: 10px;
}

.info {
  font: inherit;
  background-color: #f0f0f0;
  border: 0;
  color: #242424;
  border-radius: 0.5em;
  font-size: 1.35rem;
  padding: 0.375em 1em;
  font-weight: 600;
  text-shadow: 0 0.0625em 0 #fff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  margin-top: 15px;
  display: inline-block;
  text-decoration: none;
}

.search {
  height: 30px;
  width: 250px; 
  margin-left: 20px;
  margin-right: 20px;
  margin-top: 20px;
}

.account {
  margin-top: 10%;
  padding-top: 2px;
  width: 90%;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  margin-left: 10px;
  text-align: center;
  border-radius: 10px;
  padding-bottom: 15px;
}

.account-knop {
  width: 90%;
  background-color: white;
  margin-bottom: 5%; 
  border: 2px solid black;
  text-decoration: none;
  color: black;
  padding: 10px
}

.comment {
  margin-top: 140%;
  padding-top: 2px;
  width: 90%;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
  margin-left: 10px;
  text-align: center;
  border-radius: 10px;
  padding-bottom: 10px;
}

.comment-knop {
  width: 90%;
  background-color: white;
  margin-bottom: 5%; 
  border: 2px solid black;
  text-decoration: none;
  color: black;
  padding: 10px
}
</style>  
</head>
<body>

<div class="sidebar">
  <h1 class="active">SunTurk</h1>
<form>
<form method="GET" action="">
  <div>
    <input type="search" id="search" name="search" class="search" placeholder="Zoek een plek op…" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" />
    <button type="submit" class="search">Search</button>
  </div>
</form>

<div class="comment">
  <h2>Meningen? Ga naar comment</h2>
  <form action="commentsectie.php" method="post">
      <button class="comment-knop">Comments</button>
  </form>
</div>

<div class="account">
  <h2>Uitloggen</h2>
    <form action="logout.php" method="get">
      <button class="account-knop">uitloggen</button>
    </form>
  </div>
</div>

<div class="content">
    <div class="images">
        <?php while ($row = $bestemmingen->fetch()) : ?>
            <div class="img">
                <img src="<?= htmlspecialchars($row['foto']) ?>" alt="Foto van bestemming" width="350" height="220">
                <h2 class="plaats"><?= htmlspecialchars($row['plaats']) ?></h2>
                <h3 class="stad"><?= htmlspecialchars($row['stad']) ?></h3>
                <h4 class="activiteit">-<?= htmlspecialchars($row['activiteit1']) ?></h4>
                <h4 class="activiteit">-<?= htmlspecialchars($row['activiteit2']) ?></h4>
                <h4 class="activiteit">-<?= htmlspecialchars($row['activiteit3']) ?></h4>
                <a href="informatie.php?id=<?= $row['id'] ?>" class="info">Meer informatie</a>
              </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
