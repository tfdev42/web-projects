<?php
    // WARNINGS
    // Enable WARNINGS ON LINUX >>>>>>
    error_reporting(E_ALL);

    ini_set('display_errors','1');
    // >>>>>>>>>>>>

    /*
    Klassen werden geschrieben um eigene Datentypen yu definieren.
    Klassen koennen Daten buendeln, und diesen Daten Taetigkeiten in der Form von Methoden hinzufuegen

    Klassen repraesentieren etwas, zB. Kunde, Produkt ...
    Klassen fruppieren Informationen in logischen Einheiten
    --> Kundennummer, Name, Adresse wird in Klasse "Kunde" zusammengefasst
    --> Preis, Artikelnummer, Menge, Bezeichnung ... Klasse "Produkt"

    Die Klasse ist wie ein Bauplan, Objekte sind spezifische Beispiele der Klassen
    Objekt der Klasse Kunde zB. "5, Hansi, Hauptstr.1"
    >>> OOP:
    - Vererbung (inheritance)
    - Kapselung (encapsulation)
    - Polymoorphie (polymorphism)

    neue Klasse:
    Name: was moechte ich modellieren, zB Auto
    - Attribute (Eigenschaften) : Variablen (welche Informationen)
    - Methoden
    - Konstruktor

    */

    class Product {
        // Eigenschaften (Instanzvariablen, Klassenvariablen)
        public int $articleNumber;
        public string $name;
        public float $price;
        // MwStS 13.5% --> 0.135
        public float $vatRatePct;

        public function __construct(int $articleNumber, string $name, float $price, float $vatRatePct) {
            $this->articleNumber = $articleNumber;
            $this->name = $name;
            $this->price = $price;
            $this->vatRatePct = $vatRatePct;
        }

        public function getPriceWithVAT() : float { //Rueckgabe Wert = FLOAT
            return $this->price * ($this->vatRatePct + 1);
        }

    }

    // Objekte der Klasse Product erzeugen
    $p1 = new Product(1, "Tisch", 100, 0.2);

    // Wie ist der Brutto Preis des Produkts?
    $priceWithVAT = $p1->getPriceWithVAT();

    echo "<p>Bruttopreis betraegt $priceWithVAT</p>";

    $p2 = new Product(5, "Sessel", 250, 0.2);

    class Person {
        public string $name;
        public ?int $svnr;


        public function __construct(string $name, ?int $svnr){
            $this->name = $name;
            $this->svnr = $svnr;
        }

        public function printMe() : void {
            echo "<p>$this->name $this->svnr</p>";
        }
    }

    $hansi = new Person("Hansi", 123456);
    $susi = new Person("Susi", null);
    
    $hansi->printMe();
    $susi->printMe();


?>