<?php

    class Rectangle {

        public float $laenge;
        public float $hoehe;

        public function __construct(float $laenge, float $hoehe){
            $this->laenge = $laenge;
            $this->hoehe = $hoehe;
        }

        public function getArea() : float {
            return $this->laenge * $this->hoehe;
        }

        public function getCircumference() : float {
            return 2 * ($this->laenge + $this->hoehe);
        }

        
    }

    $r1 = new Rectangle(1.5, 22.5);
    $r2 = new Rectangle(3, 3);
    
    $umfang = $r1->getCircumference();
    echo "<p>Der Umfang ist $umfang</p><br>";

    //$flaeche = $r2->getCircumference();
    echo '<p>Umfang : ' . $r2->getCircumference() . '</p>';
    //echo "<p>Die Flaeche ist $flaeche</p><br>";



?>