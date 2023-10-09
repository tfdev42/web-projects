<?php
declare(strict_types=1);

namespace SelfHtml\Todo\Persistence;

use \PDO;
use \OutOfBoundsException;
use \other\todo\Domain\TodoItem;

/**
 * Eine TodoItemResource repräsentiert einen existierenden Datensatz, der ein TodoItem enthält.
 * Der Datensatz wird durch eine eindeutige ID identifiziert, in diesem Fall ist
 * das eine von SQL generierte ID. Die TodoItemResource ist dafür verantwortlich, den Datensatz
 * auszulesen, ihn zu überschreiben und zu löschen.
 */
final class TodoItemResource
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * @var int
     */
    private $id;

    /**
     * Erzeugt eine Resource mit der angegebenen Datenbank-Verbindung und Datensatz-ID.
     * Der Konstruktur erstellt keinen neuen Datensatz in der Datenbank, er muss
     * stattdessen mit der ID eines bereits existierenden Datensatzes aufgerufen werden.
     * Für die Erstellung neuer Datensätze ist das Repository verantwortlich.
     *
     * @param PDO $pdo Datenbank-Verbindung
     * @param int $id Datensatz-ID
     */
    public function __construct(PDO $pdo, int $id)
    {
        $this->pdo = $pdo;
        $this->id = $id;
    }

    /**
     * Gibt die Datensatz-ID der Ressource zurück.
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Liest das TodoItem aus dem Datensatz aus.
     *
     * @throws OutOfBoundsException falls der zu lesende Datensatz nicht existiert.
     *
     * @return TodoItem
     */
    public function fetch() : TodoItem
    {
        static $query = 'SELECT `state`, `description` FROM `todo` WHERE `id` = :id';
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute([':id' => $this->id]);
        if ($statement->rowCount() === 0) {
            throw new OutOfBoundsException();
        }
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $todoItem = new TodoItem((int) $row['state'], $row['description']);
        return $todoItem;
    }

    /**
     * Überschreibt den Datensatz mit einem neuen TodoItem.
     *
     * @throws OutOfBoundsException falls der zu aktualisierende Datensatz nicht existiert.
     *
     * @param TodoItem neuer Datensatz
     */
    public function update(TodoItem $todoItem) : void
    {
        static $query = <<<SQL
            UPDATE `todo`
            SET `state` = :state, `description` = :description
            WHERE `id` = :id
            SQL;
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            ':id' => $this->id,
            ':state' => $todoItem->getState(),
            ':description' => $todoItem->getDescription()
        ]);
        if ($statement->rowCount() === 0) {
            throw new OutOfBoundsException();
        }
    }

    /**
     * Löscht den Datensatz.
     *
     * @throws OutOufBoundsException falls der zu löschende Datensatz nicht existiert.
     */
    public function delete() : void
    {
        static $query = <<<SQL
            DELETE FROM `todo`
            WHERE `id` = :id
            SQL;
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            ':id' => $this->id
        ]);
        if ($statement->rowCount() === 0) {
            throw new OutOfBoundsException();
        }
    }
}