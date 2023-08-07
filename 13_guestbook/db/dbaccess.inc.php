<?php
class DbAccess {
        // Zugriff auf DBs: PDO(fuer allgem. DBs), mysqli, mysql

        private PDO $conn;

        public function register(string $email, string $password, string $name, DateTime $birthdate, bool $newsletter) : int {

            $ps = $this->conn->prepare('
            INSERT INTO user
            (email, password, name, birthdate, newsletter)
            VALUES
            (:email, :pw, :name, :birthdate, :newsletter)
            ');
            $ps->bindValue('email', $email);
            $ps->bindValue('pw', password_hash($password, PASSWORD_DEFAULT)); // PW Hashing
            $ps->bindValue('name', $name);
            $ps->bindValue('birthdate', $birthdate->format('Y-m-d')); // Y-m-d *muss das Format sein*
            $ps->bindValue('newsletter', $newsletter, PDO::PARAM_BOOL); // bei BOOL explicit sage, dass es ein BOOLIAN ist
            $ps->execute();
            return $this->conn->lastInsertId();


        }

        public function __construct() {
            // Aufbau der DB connection mit PDO
            $host = 'localhost';
            $dbName = '20230726_guestbook';
            $dbUser = 'root';
            $dbPassword = '';

            $conn = new PDO("mysql:dbname=$dbName; host=$host", $dbUser, $dbPassword);
            // DB/Fehlermeldungen sollen angezeigt werden
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn = $conn;
        }
}
?>