<?php
require "etudiant.php";
?>

<div style="display: flex;gap:20px">
    <div style='border:black solid 1px;border-radius:4px;'>
        <?php
        $e1 = new etudiant("aymen", [11,13,18,7,10,13,2,5,1]);
        $e1->afficheNotes();
        $e1->afficherMoyenne();
        ?>
    </div>

    <div style='border:black solid 1px;border-radius:4px;'>
        <?php
        $e2 = new etudiant("skander", [15,9,8,16]);
        $e2->afficheNotes();
        $e2->afficherMoyenne();
        ?>
    </div>
</div>