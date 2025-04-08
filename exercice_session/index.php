<?php
    include 'session.php';

    $session = new Manager();
    $visitCount = $session->getVisitCount();

    if (isset($_POST['reset'])) {
        $session->resetSession();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Sessions</title>
</head>
<body>
<link rel="stylesheet" href="styles.css">
    <h1>
        <?php 
        if ($visitCount == 1) {
            echo "Bienvenue sur notre plateforme !";
        } else {
            echo "Merci pour votre fidélité, c'est votre $visitCount ème visite.";
        }
        ?>
    </h1>
    <div class="container">
        <form method="post">
            <button type="submit" name="reset">Reset</button>
        </form>
    </div>
</body>
</html>