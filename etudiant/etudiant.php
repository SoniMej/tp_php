<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

class etudiant {
    private $nom;
    private array $notes;

    public function __construct(string $nom, array $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function getNom() {
        return $this->nom;
    }

    public function afficheNotes() {
        echo "<div style='background-color:rgb(243, 240, 240);width:250px;border-radius:3px;inli'>";
        echo $this->getNom();
        echo"</div>";
        foreach ($this->notes as $note) {
            $couleur = '';
            if ($note < 10) {
                $couleur = "rgb(252, 208, 208)";
            } elseif ($note > 10) {
                $couleur = "rgb(195, 236, 189)";
            } else {
                $couleur =" rgb(250, 245, 194)";
            }
            echo "<div style=' background-color: $couleur; width:250px; '>$note</div>";
        }
    }

    public function calculerMoyenne() {
        $s=0;
        foreach($this->notes as $note){
            $s+=$note;
        }
        return $s / count($this->notes);
    }
    public function afficherMoyenne(){
        echo "<div style='background-color:rgb(180, 219, 241);width:250px;border-radius:2px;'>";
        echo "votre moyenne est ".$this->calculerMoyenne();
        echo "</div>";

    }
    public function estAdmis() {
        return $this->calculerMoyenne() >= 10;
    }


    
} ?>

</body>
</html>