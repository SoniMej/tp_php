<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    class attackPokemon{
        public $attackMinimal;
        public $attackMaximal;
        public $specialAttack;
        public $probabilitySpecialAttack;

        public function __construct($min, $max, $special, $prob) {
            $this->attackMinimal = $min;
            $this->attackMaximal = $max;
            $this->specialAttack = $special;
            $this->probabilitySpecialAttack = $prob;
        }

        public function getAttackMinimal() {
            return $this->attackMinimal;
        }

        public function getAttackMaximal() {
            return $this->attackMaximal;
        }

        public function getSpecialAttack() {
            return $this->specialAttack;
        }

        public function getProbabilitySpecialAttack() {
            return $this->probabilitySpecialAttack;
        }

        public function getAttackPoints() {
            $atk = rand($this->attackMinimal, $this->attackMaximal);
            $prob = rand(1, 100);
            if ($prob <= $this->probabilitySpecialAttack) {
                echo " Attaque spéciale !";
                return $atk * $this->specialAttack;
            }
            return $atk;
        }
    }

    class pokemon{
        public string $name;
        public string $url;
        public int $hp;
        public attackPokemon $attackPokemon;

        public function __construct(string $name, string $url, int $hp, attackPokemon $attackPokemon) {
            $this->name = $name;
            $this->url = $url;
            $this->hp = $hp;
            $this->attackPokemon = $attackPokemon;
        }

        public function getName(): string {
            return $this->name;
        }

        public function getUrl(): string {
            return $this->url;
        }

        public function getHp(): int {
            return $this->hp;
        }

        public function getAttackPokemon(): attackPokemon {
            return $this->attackPokemon;
        }

        public function setName(string $name): void {
            $this->name = $name;
        }

        public function setUrl(string $url): void {
            $this->url = $url;
        }

        public function setHp(int $hp): void {
            $this->hp = $hp;
        }

        public function setAttackPokemon(attackPokemon $attackPokemon): void {
            $this->attackPokemon = $attackPokemon;
        }

        public function isDead(): bool {
            return $this->hp <= 0;
        }

        public function attack($target) {
            $damage = $this->attackPokemon->getAttackPoints();
            echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

            echo "{$this->name} attaque {$target->name} et inflige $damage points de dégâts.<br>";
            echo "</div>";
            $target->hp -= $damage;
        }

        public function whoAmI() {
            echo "<div style='border:1px solid black; width:200px; background-color:rgb(210, 210, 210)'><br>";
            echo $this->name;
            echo "<img src='{$this->url}' width='50px' height='50px'><br>";
            echo "<hr>";
            echo "points:". $this->hp."<br>";
            echo "<hr>";
            echo "Min Attack Points: ". $this->attackPokemon->getAttackMinimal()."<br>";
            echo "<hr>";
            echo "Max Attack Points: ". $this->attackPokemon->getAttackMaximal()."<br>";
            echo "<hr>";
            echo "Special attack: ". $this->attackPokemon->getSpecialAttack()."<br>";
            echo "<hr>";
            echo "Probability special attack: ". $this->attackPokemon->getProbabilitySpecialAttack()."<br>";
            echo "</div>";
        }
    }
    $pa1 = new attackPokemon(10, 100, 2, 20); 
    $pa2 = new attackPokemon(30, 80, 4, 20);
    $p1 = new pokemon("pikachu", "https://www.freeiconspng.com/thumbs/pikachu-transparent/pikachu-transparent-hd-1.png", 200, $pa1);
    $p2 = new pokemon("goupix", "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/037.png", 200, $pa2);
    echo "<div style='background-color:rgb(152, 212, 255);height:30px;width:405px;'>";
    echo "les combattements entre des pokémons normaux";
    echo "</div>";

    $counter=1;
    
    while (true) {
        echo "<div style='display: flex;gap:2px;'>";
        $p1->whoAmI();
        $p2->whoAmI();
        echo"</div>";
        echo "<div style='background-color:rgb(249, 193, 179);height:120px;width:405px;'>";
        echo "round ".$counter;


        $p1->attack($p2);
        
        if ($p2->isDead() && $p1->isDead()){

            if($p1->points<$p2->points){
                echo "<div style='display: flex;gap:2px;'>";
                $p1->whoAmI();
                $p2->whoAmI();
            echo"</div>";
                echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

                echo "Le vainqueur est <img src='{$p1->url}' width='50px' height='50px'><br>";
                echo "</div>";

                break;


            }
            else{
                echo "<div style='display: flex;gap:2px;'>";
                $p1->whoAmI();
                $p2->whoAmI();
                echo"</div>";
                echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

                echo "Le vainqueur est <img src='{$p2->url}' width='50px' height='50px'><br>";
                echo "</div>";

                break;

            }
        }
        if ($p2->isDead()) {
            echo "<div style='display: flex;gap:2px;'>";
            $p1->whoAmI();
            $p2->whoAmI();
            echo"</div>";
            echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

            echo "Le vainqueur est <img src='{$p1->url}' width='50px' height='50px'><br>";
            echo "</div>";

            break;
        }

        $p2->attack($p1);
        
        if ($p1->isDead()) {
            echo "<div style='display: flex;gap:2px;'>";
            $p1->whoAmI();
            $p2->whoAmI();
            echo"</div>";
            
            echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

            
            echo "Le vainqueur est <img src='{$p2->url}' width='50px' height='50px'><br>";
            echo "</div>";

            break;
        }
echo "</div>";
        $counter++;
    }

    class PokemonFeu extends pokemon {
        public function __construct(string $name, string $url, int $hp, attackPokemon $attackPokemon) {
            parent::__construct($name, $url, $hp, $attackPokemon);
        }
        public function attack($p){
            $damage = $this->attackPokemon->getAttackPoints();
            if($p instanceof PokemonPlante){
                $x=$damage*2;
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $x points de dégâts.<br>";
                echo "</div>";
                $p->hp -= $x;

            }
            elseif($p instanceof PokemonEau || $p instanceof PokemonFeu){
                $x=$damage*0.5;
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $x points de dégâts.<br>";
                echo "</div>";
                $p->hp -= $x;

            }
            else{
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $damage points de dégâts.<br>";
                echo "</div>";
                $p->hp -= ($damage);

            }
        }
    }

    class PokemonEau extends pokemon {
        public function __construct(string $name, string $url, int $hp, attackPokemon $attackPokemon) {
            parent::__construct($name, $url, $hp, $attackPokemon);
        }
        public function attack($p){
            $damage = $this->attackPokemon->getAttackPoints();
            if($p instanceof PokemonFeu){
                $x=$damage*2;
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $x points de dégâts.<br>";
                echo "</div>";
                $p->hp -= $x;

            }
            elseif($p instanceof PokemonEau || $p instanceof PokemonPlante){
                $x=$damage*0.5;
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $x points de dégâts.<br>";
                echo "</div>";
                $p->hp -= $x;

            }
            else{
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $damage points de dégâts.<br>";
                echo "</div>";
                $p->hp -= ($damage);

            }
        }
    }

    class PokemonPlante extends pokemon {
        public function __construct(string $name, string $url, int $hp, attackPokemon $attackPokemon) {
            parent::__construct($name, $url, $hp, $attackPokemon);
        }
        public function attack($p){
            $damage = $this->attackPokemon->getAttackPoints();
            if($p instanceof PokemonEau){
                $x=$damage*2;

                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $x points de dégâts.<br>";
                echo "</div>";
                $p->hp -= $x;

            }
            elseif($p instanceof PokemonPlante || $p instanceof PokemonFeu){
                $x=$damage*0.5;
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $x points de dégâts.<br>";
                echo "</div>";
                $p->hp -= $x;

            }
            else{
                echo "<div style='background-color:rgb(192, 192, 192);height:30px;width:380px;margin-left:10px;margin-top:10px;'>";

                echo "{$this->name} attaque {$p->name} et inflige $damage points de dégâts.<br>";
                echo "</div>";
                $p->hp -= ($damage);

            }
        }
    }

    $paa1 = new attackPokemon(10, 100, 2, 20); 
    $paa2 = new attackPokemon(30, 80, 4, 20);
    $po1 = new PokemonFeu("dracaufeu", "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/006.png", 200, $pa1);
    $po2 = new PokemonPlante("fragilady", "https://www.pokepedia.fr/images/thumb/3/32/Fragilady-NB.png/800px-Fragilady-NB.png", 200, $pa2);

    echo "<div style='background-color:rgb(152, 212, 255);height:30px;width:405px;'>";
    echo "les combattements entre différents pokémons";
    echo "</div>";

    $counterr=1;
    
    while (true) {
        echo "<div style='display: flex;gap:2px;'>";
        $po1->whoAmI();
        $po2->whoAmI();
        echo"</div>";
        echo "<div style='background-color:rgb(249, 193, 179);height:120px;width:405px;'>";
        echo "round ".$counterr;


        $po1->attack($po2);
        
        if ($po2->isDead() && $po1->isDead()){

            if($po1->points<$po2->points){
                echo "<div style='display: flex;gap:2px;'>";
                $po1->whoAmI();
                $po2->whoAmI();
                echo"</div>";
                echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

                echo "Le vainqueur est <img src='{$po1->url}' width='50px' height='50px'><br>";
                echo "</div>";

                break;


            }
            else{
                echo "<div style='display: flex;gap:2px;'>";
                $po1->whoAmI();
                $po2->whoAmI();
                echo"</div>";
                echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

                echo "Le vainqueur est <img src='{$po2->url}' width='50px' height='50px'><br>";
                echo "</div>";

                break;

            }
        }
        if ($po2->isDead()) {
            echo "<div style='display: flex;gap:2px;'>";
            $po1->whoAmI();
            $po2->whoAmI();
            echo"</div>";
            echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

            echo "Le vainqueur est <img src='{$po1->url}' width='50px' height='50px'><br>";
            echo "</div>";

            break;
        }

        $po2->attack($po1);
        
        if ($po1->isDead()) {
            echo "<div style='display: flex;gap:2px;'>";
            $po1->whoAmI();
            $po2->whoAmI();
            echo"</div>";
            
            echo "<div style='background-color:rgb(194, 235, 198);height:80px;width:405px;'>";

            
            echo "Le vainqueur est <img src='{$po2->url}' width='50px' height='50px'><br>";
            echo "</div>";

            break;
        }
echo "</div>";
        $counterr++;}
    ?>
</body>
</html>