<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$db = new Database();
$conn = $db->getConnection();


$sectionsStmt = $conn->prepare("SELECT * FROM section");
$sectionsStmt->execute();
$sections = $sectionsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des Sections</title>
    <style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(120deg, #fbe4f0, #e5d1f2);
    color: #5e005e;
    padding: 40px;
  }

  header {
    background: rgba(255, 255, 255, 0.9);
    padding: 20px 30px;
    margin-bottom: 30px;
    border-left: 8px solid #d63384;
    box-shadow: 0 5px 15px rgba(212, 50, 150, 0.15);
  }

  header h1 {
    margin: 0;
    font-size: 28px;
    color: #c2185b;
  }

  header p {
    margin: 5px 0 10px;
    font-weight: bold;
  }

  a {
    color: #a020f0;
    text-decoration: none;
    font-weight: bold;
    margin-right: 15px;
  }

  a:hover {
    color: #d81b60;
    text-decoration: underline;
  }

  h2 {
    color: #ba1d7a;
    margin-top: 0;
  }

  table {
    width: 100%;
    background-color: #fff0fa;
    border-radius: 12px;
    overflow: hidden;
    border-collapse: collapse;
    box-shadow: 0 0 12px rgba(255, 105, 180, 0.3);
  }

  th, td {
    padding: 14px 16px;
    text-align: left;
  }

  th {
    background-color: #ebc1fc;
    color: #6a1b9a;
    font-weight: bold;
  }

  td {
    border-bottom: 1px solid #f5d7f5;
  }

  tr:hover {
    background-color: #f8e6f8;
  }

  img {
    vertical-align: middle;
    transition: transform 0.2s ease-in-out;
  }

  img:hover {
    transform: scale(1.1);
  }
</style>

</head>
<body>

<header>
    <h1>Bienvenue <?php echo $_SESSION['username']; ?> 👋</h1>
    <p>Rôle : <?php echo $_SESSION['role']; ?></p>
    <a href="logout.php">Se déconnecter</a> | <a href="home.php">Retour à l'accueil</a>
</header>

<h2>📗 Liste des Sections</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Désignation</th>
        <th>Description</th>
        <th>actions</th>
    </tr>
    <?php foreach ($sections as $section): ?>
        <tr>
            <td><?= $section['id'] ?></td>
            <td><?= $section['designation'] ?></td>
            <td><?= $section['description'] ?></td>
            <td>
              <a href="liste_etudiantparsection.php?id=<?= $section['id'] ?>">
                    <img src="liste.jpg" alt="Liste" style="width:35px;" />
              </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
