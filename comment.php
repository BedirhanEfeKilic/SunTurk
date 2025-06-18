<?php

function setComments($pdo) {
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $datum = $_POST['datum'];
        $bericht = $_POST['bericht'];

        $sql = "INSERT INTO commentsectie (uid, datum, bericht) VALUES ('$uid', '$datum', '$bericht')";
        $resultaat = $pdo->query($sql);

        header('Location: commentsectie.php');
        exit;
    }
}

function getComments($pdo) {
    $sql = "SELECT * FROM `commentsectie` INNER JOIN `gebruikers` ON commentsectie.uid = gebruikers.id";
    $resultaat = $pdo->query($sql);
    
    while ($row = $resultaat->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='comment'>";
            echo htmlspecialchars($row['username']) . "<br>";
            echo htmlspecialchars($row['datum']) . "<br>";
            echo htmlspecialchars($row['bericht']);
        echo "</div>";
    }
}
