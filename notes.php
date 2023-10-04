<?php
class FormValidator {
    private $data;
    private $errors = [];

    public function __construct($data) {
        $this->data = $data;
    }

    public function validateRequired($field, $label) {
        if (empty($this->data[$field])) {
            $this->addError($field, "$label is required.");
        }
    }

    public function validateEmail($field, $label) {
        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, "$label is not a valid email address.");
        }
    }

    public function getErrors() {
        return $this->errors;
    }

    private function addError($field, $message) {
        $this->errors[$field] = $message;
    }
}

// Example usage:
$data = $_POST;
$validator = new FormValidator($data);
$validator->validateRequired('email', 'Email');
$validator->validateEmail('email', 'Email');

$errors = $validator->getErrors();
if (!empty($errors)) {
    // Handle validation errors
}
?>


*** Log4J - CVE-2022-23307
*** Software-Lizenzen
*** AT Copyright vs USA copyright
*** DSGVO - Eckpunkte
*** EULA - End User License Agreement - AGBs
*** HTTPS - Funktion
