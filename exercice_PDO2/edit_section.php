<?php
session_start();
require_once 'db.php';
require_once 'sections.php';

if (!isset($_GET['id'])) {
  echo "ID not provided";
  header("Location: liste_Section.php");
  exit;
}
$db = new Database();
$conn = $db->getConnection();
$id = $_GET['id'];
$stconn = new Section($conn);
$section = $stconn->getsectionById($id);

if (!$section) {
  echo "section not found";
  header("Location: sections_list.php");
  exit;
}

if (isset($_POST['submit'])) {
  $designation = $_POST['designation'];
  $descriptiion = $_POST['description'];
  $stconn->updateSection($id, $designation, $descriptiion);

  header("Location: sections_list.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit section</title>
  
</head>

<body>
  <div >
    <form method="POST">
      <div >
        <div >
          <div >
            <div>
              <label for="designation" class="form-label">Designation</label>
              <input type="text" class="form-control" id="designation" name="designation" placeholder="Enter designation" value="<?= $section['designation']?>">
            </div>
            <div >
              <label for="description" >Description</label>
              <input type="text"  id="description" name="description" placeholder="Enter description" value="<?= $section['description'] ?>">
            </div>
          </div>
        </div>
      </div>
      <div >
        <a href="liste_Section.php"><button type="button" >Return</button></a>
        <button type="reset" >Reset</button>
        <button type="submit" name="submit">Submit</button>
      </div>
    </form>
  </div>
</body>

</html>