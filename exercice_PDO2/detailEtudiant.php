<?php
session_start();
require_once 'db.php';
require_once 'students.php';

if (!isset($_GET['id'])) {
  echo "ID not provided";
  exit;
}
$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$stconn = new Student($conn);
$student = $stconn->getStudentById($id);

if (!$student) {
  echo "Student not found";
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Details</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #ffd1f4, #e0c3fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }

    .card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      padding: 40px;
      width: 100%;
      max-width: 600px;
      text-align: center;
    }

    .card img {
      width: 180px;
      height: 180px;
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 20px;
      border: 4px solid #e0c3fc;
    }

    h2 {
      color: #7a018a;
      margin-bottom: 20px;
    }

    .info-block {
      text-align: left;
      margin-bottom: 20px;
    }

    .info-block strong {
      color: #880e4f;
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .back-btn {
      background: #d1c4e9;
      color: #4a148c;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      padding: 12px 20px;
      border-radius: 10px;
      font-weight: bold;
      transition: 0.3s;
    }

    .back-btn:hover {
      background: #b39ddb;
    }
  </style>
</head>
<body>

  <div class="card">
    <img src="<?= $student['image'] ?>" alt="Image de l'étudiant">
    
    <h2><?= $student['name'] ?></h2>

    <div class="info-block">
      <strong>ID :</strong>
      <?= $student['id'] ?>
    </div>

    <div class="info-block">
      <strong>Section :</strong>
      <?= $student['section'] ?>
    </div>

    <div class="info-block">
      <strong>Date de naissance :</strong>
      <?= $student['birthday'] ?>
    </div>

    <a href="students_list.php" class="back-btn">⬅ Retour à la liste</a>
  </div>

</body>
</html>