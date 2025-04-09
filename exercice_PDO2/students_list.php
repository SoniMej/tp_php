<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


$db = new Database();
$conn = $db->getConnection();

$studentsStmt = $conn->prepare("SELECT * FROM etudiant");
$studentsStmt->execute();
$students = $studentsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <title>Liste des Étudiants</title>
  <style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #f8d0e4, #e2c5f2);
    color: #4b0049;
    padding: 40px;
  }

  header {
    background: rgba(255, 255, 255, 0.8);
    padding: 15px 30px;
    margin-bottom: 30px;
    border-left: 6px solid #d63384;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  header h1 {
    margin: 0;
    font-size: 28px;
    color: #c2185b;
  }

  header p {
    margin: 5px 0;
    font-weight: bold;
  }

  a {
    color: #a020f0;
    text-decoration: none;
    font-weight: bold;
    margin-right: 15px;
  }

  a:hover {
    color: #e91e63;
    text-decoration: underline;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff0fa;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(255, 105, 180, 0.3);
  }

  th, td {
    padding: 12px 15px;
    text-align: left;
  }

  th {
    background-color: #e6b3f9;
    color: #6a1b9a;
  }

  td {
    border-bottom: 1px solid #f3d1f3;
  }

  tr:hover {
    background-color: #f9e2f9;
  }

  h2 {
    color: #ba1d7a;
    margin-top: 0;
  }

  img {
    vertical-align: middle;
  }

  .btn {
    background: none;
    border: none;
    cursor: pointer;
  }

  form {
    display: inline;
  }


  .dt-button {
    background-color: #f06292 !important;
    border: none !important;
    color: white !important;
    border-radius: 5px !important;
    padding: 6px 12px !important;
    margin-right: 5px;
  }

  .dt-button:hover {
    background-color: #d81b60 !important;
  }
</style>
</head>
<body>

<header>
    <h1>Bienvenue <?php echo $_SESSION['username']; ?> 👋</h1>
    <p>Rôle : <?php echo $_SESSION['role']; ?></p>
    <a href="logout.php">Se déconnecter</a> | <a href="home.php">Retour à l'accueil</a>
</header>

<h2>📘 Liste des Étudiants</h2>
<a href="ajouter_etudiant.php" >
    <img src="add.png" alt="Ajouter" style="height:30px; cursor:pointer;">
</a>
<br><br>
<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Date de naissance</th>
        <th>Image</th>
        <th>Section</th>
        <th>actions</th>
    </tr>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student['id'] ?></td>
            <td><?= $student['name'] ?></td>
            <td><?= $student['birthday'] ?></td>
            <td><?= $student['image'] ?></td>
            <td><?= $student['section'] ?></td>
            <td>
                <a href="detailEtudiant.php?id=<?= $student['id'] ?>">
                  <img src="info.png" alt="details" style="width:25px;" />
                </a>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                  <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $student['id'] ?>" />
                    <button name="delete" class="btn border-0 p-0">
                      <img src="supp.png" alt="Delete" style="width:30px;" />
                    </button>
                  </form>
                  <a href="edit_student.php?id=<?= $student['id'] ?>">
                    <img src="edit.png" alt="edit" style="width:35px;" />
                  </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<script>
    $(document).ready(function() {
      const table = $('#studentTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf'
          <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>, {
              text: '<img src="add_icone.png" alt="Ajouter étudiant" style="height:25px;">',
              action: function() {
                window.location.href = 'ajouter_etudiant.php';
              }
            }
          <?php endif; ?>
        ],
        language: {
          url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json"
        }
      });
    });
  </script>
</body>
</html>
