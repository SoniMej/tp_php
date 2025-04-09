<?php
include 'data.php';

$st = $pdo->query("SELECT * FROM student");
$students = $st->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
</head>
<body>
    <h2>Liste des étudiants</h2>
    <link rel="stylesheet" href="styles.css">
    <table >
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Date de naissance</th>
            
        </tr>
        <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= $student['name'] ?></td>
                <td><?= $student['birthdate'] ?></td>
                <td><a href="detailEtudiant.php?id=<?=$student['id'] ?>">
                        <img src="info.jpg" style="width:20px;height:20px;">
                    </a>
                </td>
            
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>