<?php
include 'data.php';
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM student WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Détails Étudiant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="student-details">
        <h1><?=$student['name']?></h1>
        <p><?= $student['birthdate'] ?></p>
        <a href="index.php">Retour</a>
    </div>
</body>
</html>
