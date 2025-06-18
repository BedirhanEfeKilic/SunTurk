<?php
    date_default_timezone_set('Europe/Amsterdam');
    include 'database.php';
    include 'comment.php';

session_start();
if (!isset($_SESSION['LoggedInUser'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="logo2.png" type="image/x-icon">
    <title>SunTurk.com</title>
    <style>
.comment-sectie {
  height: 95%;
  width: 95%;
  background: white;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);    
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  overflow-y: auto;
}

.bericht {
  display: block;
  margin: 0 auto;
  width: 500px;
  height: 150px;
}

.comment-knop {
  display: block;
  width: 200px;       
  height: 40px;
  margin: 0 auto 10px auto;
  text-align: center;
  cursor: pointer;
  font-size: 16px;
}

.comment {
  width: 800px;
  padding: 10px;  
  border: 2px solid black;
  background-color:rgb(224, 224, 224);
  margin-bottom: 5px
}

textarea {
  resize: none;
}

a {
  text-decoration: none;
  color: black;
}
    </style>
</head>
<body>
<div class='comment-sectie'>
<a class=terug href="index.php">↺ Terug</a>
<?php
echo "<form method='POST' action='".setComments($pdo)."'>
  <input type='hidden' name='uid' value='".$_SESSION['UserID']."'>
  <input type='hidden' name='datum' value='".date('Y-m-d H:i:s')."'>
  <textarea class='bericht' name='bericht'></textarea><br>
  <button class='comment-knop' type='submit' name='commentSubmit'>Comment</button>
</form>";

getComments($pdo);
?>
</div>
</body>
</html>
