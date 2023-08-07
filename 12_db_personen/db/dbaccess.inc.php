<?php
require_once 'models.inc.php';

    class DbAccess {
        // Zugriff auf DBs: PDO(fuer allgem. DBs), mysqli, mysql

        private PDO $conn;

        public function __construct() {
            // Aufbau der DB connection mit PDO
            $host = 'localhost';
            $dbName = '20230712_grz_personen';
            $dbUser = 'root';
            $dbPassword = '';

            $conn = new PDO("mysql:dbname=$dbName; host=$host", $dbUser, $dbPassword);
            // DB/Fehlermeldungen sollen angezeigt werden
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn = $conn;
        }

        public function createPerson(string $name, float $heightCm, float $weightKg) : int {
            // Speichert eine neue Person in der Datenbank, gibt die ID der erzeigten Person zurueck

            // erstelle eine prepared statement
            $ps = $this->conn->prepare('
            INSERT INTO person
            (name, height_cm, weight_kg)
            VALUES
            (:name, :cm, :kg)
            ');

            // named parameter mit den eigentlichen Werten ersetzen
            $ps->bindValue('name', $name);
            $ps->bindValue('cm', $heightCm);
            $ps->bindValue('kg', $weightKg);

            //das fertige SQL statement an die Datenbank schicken
            $ps->execute();

            // wie ist die ID der Person
            $id = $this->conn->lastInsertId();
            return $id;


        }

        // liefert alle in der Datenbank gespeicherten Datensaetze
        // der Tabelle person als Array von Objekten der Klasse Peson zurueck
        // Die Klasse Person wird in models.inc.php gespeichert
        public function getPeople() : array {
            $ps = $this->conn->prepare('
            SELECT *
            FROM person
            ');
            $ps->execute();
            // sammle alle gefundenenn Personen in diesem Array
            // als objekte der Klasse person
            $persons = [];
            // row ist immer genau 1 Datensatz
            // fetch() liefert immer den naechsten Datensatz
            while($row = $ps->fetch()){
                // row ist ein Assoziatives Array (key/value paare):
                // Key: isr Spaltenname
                // Value: ist der in der Spalte gespeicherte Wert
                print_r($row);
                // erstell aus dem Datensatz ein Obj der Klasse Person
                $p = new Person($row["id"], $row['name'], $row['height_cm'], $row['weight_kg']);

                // fuege das Obj in das persons[] ein
                $persons[] = $p;
            }

            // Gebe Array mit Obj von Klasse Person zurueck
            return $persons;
        }


        public function getPersonById($id) : Person|false {
            $ps = $this->conn->prepare('
            SELECT *
            FROM person
            WHERE id = :id
            ');
            $ps->bindValue('id', $id);
            $ps->execute();

            // wurde ein Datensatz gefunden?
            if ($row = $ps->fetch()){
                // neues Obj
                $p = new Person($row["id"], $row['name'], $row['height_cm'], $row['weight_kg']);
                // Gebee Obj yurueck
                return $p;
            }
            // wenn keine Person mit dieser ID gefunden wurde
            return false;
        }


        public function updatePerson(Person $p){
            $ps = $this-> conn -> prepare('
            UPDATE person
            SET name = :name, weeight_kg = :kg, height_cm = :cm
            WHERE id = :id
            ');
            $ps->bindValue('name', $p->name);
            $ps->bindValue('kg', $p->weightKg);
            $ps->bindValue('cm', $p->heightCm);
            $ps->bindValue('id', $p->id);
            $ps->execute();

        }

        public function deletePerson($id){
            $ps = $this->conn->prepare('
            DELETE FROM person
            WHERE id = :id
            ');
            $ps->bindValue('id', $id);
            $ps->execute();
        }




    }


?>