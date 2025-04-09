<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: home.php");
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      height: 100vh;
      display: flex;
      background: linear-gradient(to right, #ffe1f0, #e0c3fc);
    }

    .container {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 40px;
    }

    .login-image {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-image img {
      width: 90%;
      max-width: 500px;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }

    .login-form {
      flex: 1;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      padding: 40px 50px;
      border-radius: 20px;
      box-shadow: 0 12px 25px rgba(240, 46, 170, 0.25);
      margin-left: 60px;
      max-width: 450px;
    }

    .login-form h2 {
      color: #c2185b;
      margin-bottom: 25px;
      font-size: 30px;
      text-align: center;
    }

    .login-form label {
      display: block;
      margin-bottom: 5px;
      font-weight: 600;
      color: #6a1b9a;
    }

    .login-form input {
      width: 100%;
      padding: 12px;
      margin-bottom: 20px;
      border: 1px solid #d39ed6;
      border-radius: 10px;
      background: #fdf3fa;
      font-size: 16px;
    }

    .login-form button {
      width: 100%;
      padding: 14px;
      border: none;
      background-color: #d63384;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .login-form button:hover {
      background-color: #ba1b6f;
    }

    .error-message {
      color: red;
      margin-bottom: 15px;
      text-align: center;
      font-weight: bold;
    }

    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        justify-content: center;
        padding: 20px;
      }

      .login-image {
        margin-bottom: 30px;
      }

      .login-form {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="login-image">
      <img src="login.avif" alt="Image de connexion">
    </div>

    <div class="login-form">
      <h2>Connexion</h2>

      <?php if (isset($error)) : ?>
        <p class="error-message"><?= $error ?></p>
      <?php endif; ?>

      <form method="POST">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>

        <label>Mot de passe :</label>
        <input type="password" name="password" required>

        <button type="submit">Se connecter</button>
      </form>
    </div>
  </div>

</body>
</html>