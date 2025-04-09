<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Accueil - Gestion Étudiants</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        header { background: #f0f0f0; padding: 10px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <link rel="stylesheet" href="styles.css">

<header>
    <h1>Bienvenue <?php echo $_SESSION['username']; ?> 👋</h1>
    <p>Rôle : <?php echo $_SESSION['role']; ?></p>
    <a href="logout.php">Se déconnecter</a>
</header>

<h2>Page d'accueil</h2>
<p>Accédez aux pages suivantes :</p>
<ul>
    <li><a href="students_list.php">Liste des Étudiants</a></li>
    <li><a href="sections_list.php">Liste des Sections</a></li>
</ul>

</body>
</html>
