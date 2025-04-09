<?php
require_once 'db.php';

class Student
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function getAllStudents()
  {
    $stmt = $this->conn->query("SELECT * FROM etudiant");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getStudentById($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM etudiant WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getStudentBySection($section)
  {
    $stmt = $this->conn->query("SELECT * FROM etudiant WHERE section = '$section'");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addStudent($name, $birthday, $image, $section)
  {
    $stmt = $this->conn->prepare("INSERT INTO etudiant (name, birthday, image, section) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$name, $birthday, $image, $section]);
  }

  public function updateStudent($id, $name, $birthday, $image, $section)
  {
    $stmt = $this->conn->prepare("UPDATE etudiant SET name=?, birthday=?, image=?, section=? WHERE id=?");
    return $stmt->execute([$name, $birthday, $image, $section, $id]);
  }

  public function deleteStudent($id)
  {
    $stmt = $this->conn->prepare("DELETE FROM etudiant WHERE id = ?");
    return $stmt->execute([$id]);
  }
}