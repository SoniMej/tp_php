<?php
session_start();
require_once 'db.php';
require_once 'students.php';
require_once 'sections.php';

if (!isset($_GET['id'])) {
  echo "ID not provided";
  header("Location: sections_list.php");
  exit;
}
$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$secConn = new Section($conn);
$section = $secConn->getSectionById($id);
$stConn = new Student($conn);
$students = $stConn->getStudentBySection($section['designation']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Session Manager</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom right, #ffe3ec, #e0c3fc);
      color: #4a004e;
      padding: 0;
    }

    nav {
      background: linear-gradient(to right, #f7797d, #c471ed);
      padding: 15px 30px;
      color: white;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    nav ul {
      display: flex;
      gap: 25px;
      list-style: none;
      margin: 0;
      padding: 0;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 1em;
    }

    nav a:hover {
      text-decoration: underline;
    }

    .container {
      padding: 30px 50px;
    }

    h2 {
      margin-bottom: 25px;
      color: #7a018a;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 12px 15px;
      text-align: center;
    }

    th {
      background: #e0aaff;
      color: #4a004e;
    }

    td img {
      border-radius: 50%;
      object-fit: cover;
    }

    .actions img {
      margin: 0 5px;
      cursor: pointer;
      transition: 0.2s;
    }

    .actions img:hover {
      transform: scale(1.1);
    }

    .dt-buttons button {
      background: #d291bc;
      color: white;
      border: none;
      padding: 8px 15px;
      margin-right: 10px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: bold;
    }

    .dt-buttons button:hover {
      background: #b36bbd;
    }
  </style>
</head>

<body>


  <nav>
    <div>🌸 Gestion Étudiants</div>
    <ul>
      <li><a href="home.php">Accueil</a></li>
      <li><a href="students_list.php">Étudiants</a></li>
      <li><a href="sections_list.php">Sections</a></li>
      <li><a href="logout.php">Déconnexion</a></li>
    </ul>
  </nav>


  <div class="container">
    <h2>Étudiants de la section <?= htmlspecialchars($section['designation']) ?></h2>

    <table id="studentTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Nom</th>
          <th>Date de naissance</th>
          <th>Section</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($students as $student): ?>
          <tr>
            <td><?= $student['id'] ?></td>
            <td>
              <img src="<?= $student['image'] ?>" alt="Student image" width="40" height="40">
            </td>
            <td><?= htmlspecialchars($student['name']) ?></td>
            <td><?= $student['birthday'] ?></td>
            <td><?= $student['section'] ?></td>
            <td class="actions">
              <a href="detailEtudiant.php?id=<?= $student['id'] ?>">
                <img src="info.png" alt="Info" width="25">
              </a>
              <?php if ($_SESSION['role'] === 'admin'): ?>
                <form method="POST" style="display:inline;">
                  <input type="hidden" name="id" value="<?= $student['id'] ?>" />
                  <button name="delete" style="background:none; border:none;">
                    <img src="supp.png" alt="Delete" width="30">
                  </button>
                </form>
                <a href="edit_student.php?id=<?= $student['id'] ?>">
                  <img src="edit.png" alt="Edit" width="30">
                </a>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
