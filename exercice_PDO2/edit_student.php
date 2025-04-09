<?php
session_start();
require_once 'db.php';
require_once 'students.php';

if (!isset($_GET['id'])) {
  echo "ID not provided";
  header("Location: students_list.php");
  exit;
}
$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$stconn = new Student($conn);
$student = $stconn->getStudentById($id);

if (!$student) {
  echo "Student not found";
  header("Location: students_list.php");
  exit;
}

if (isset($_POST['submit'])) {
  $name = htmlspecialchars($_POST['name']);
  $image = filter_var($_POST['image'], FILTER_SANITIZE_URL);
  $section = htmlspecialchars($_POST['section']);
  $birthday = htmlspecialchars($_POST['birthday']);
  $stconn->updateStudent($id, $name, $birthday, $image, $section);

  header("Location:students_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Student</title>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;800&display=swap" rel="stylesheet">
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
    }

    label {
      font-weight: 600;
      margin-bottom: 8px;
      display: block;
      color: #7a018a;
    }

    input, select {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 10px;
      border: 1px solid #ccc;
      background-color: #fff4fc;
      font-size: 15px;
    }

    .form-actions {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-top: 25px;
    }

    button {
      flex: 1;
      padding: 12px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }

    button[type="submit"] {
      background: #e91e63;
      color: white;
    }

    button[type="submit"]:hover {
      background: #c2185b;
    }

    button[type="reset"] {
      background: #f8bbd0;
      color: #880e4f;
    }

    button[type="reset"]:hover {
      background: #f48fb1;
    }

    .back-btn {
      background: #d1c4e9;
      color: #4a148c;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      padding: 12px;
      border-radius: 10px;
      flex: 1;
      font-weight: bold;
    }

    .back-btn:hover {
      background: #b39ddb;
    }

    @media (max-width: 600px) {
      .form-actions {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
    <form method="POST">
      <div >
        <div >
          <div >
            <div >
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="<?= $student['name']?>">
            </div>
            <div >
              <label for="image" class="form-label">Image link</label>
              <input type="url" class="form-control" id="image" name="image" placeholder="Enter Image link" value="<?= $student['image'] ?>">
            </div>
            <div >
              <label for="section" class="form-label">Section</label>
              <select class="form-select" id="section" name="section">
                <option <?= $student['section'] === 'RT' ? 'selected' : '' ?>>RT</option>
                <option <?= $student['section'] === 'GL' ? 'selected' : '' ?>>GL</option>
                <option <?= $student['section'] === 'IMI' ? 'selected' : '' ?>>IMI</option>
                <option <?= $student['section'] === 'IIA' ? 'selected' : '' ?>>IIA</option>
              </select>
            </div>
            <div >
              <label for="birthday" class="form-label">Birthday</label>
              <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Enter birthday">
            </div>
          </div>
        </div>
      </div>
      <div >
        <a href="students_list.php"><button type="button" >Return</button></a>
        <button type="reset" >Reset</button>
        <button type="submit"  name="submit">Submit</button>
      </div>
    </form>