<?php
    class Person {
        // Aus jeder Spalte der Tabelle Person wird eine Eigenschaft der Klasse Person
        public int $id;
        public string $name;
        public float $heightCm;
        public float $weightKg;

        public function __construct(int $id, string $name, float $heightCm, float $weightKg) {
            $this->id = $id;
            $this->name = $name;
            $this->heightCm = $heightCm;
            $this->weightKg = $weightKg;
            
        }

        public function bmi() : float {
            // kg / m^2
            return $this->weightKg / pow($this->heightCm / 100, 2);
        }
    }
?>