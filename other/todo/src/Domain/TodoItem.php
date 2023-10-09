<?php
declare(strict_types=1);

namespace other\todo\Domain;


final class TodoItem {
    private $state;
    private $description;

    public const STATE_PENDING = 0;
    public const STATE_DONE = 1;

    public function __construct(int $state, string $description) {
        $this->state = $state;
        $this->description = $description;
    }

    public function getState() : int {
        return $this->state;
    }

    public function getDescription() : string {
        return $this->description;
    }
}

?>