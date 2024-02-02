<?php
class MyValidator {
    
    public function sanitizeString($input) {
        return filter_var($input, FILTER_CALLBACK, ['options' => [$this, 'sanitizeStringCallback']]);
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Custom callback for string sanitization
    private function sanitizeStringCallback($value) {
        // Your custom string sanitization logic
        return strip_tags($value);  // Example: Remove HTML tags
    }
}

// Example usage
$validator = new MyValidator();

// Sanitize a string
$inputString = "<script>alert('Hello!');</script>";
$sanitizedString = $validator->sanitizeString($inputString);
echo $sanitizedString;  // Output: alert('Hello!');

// Validate an email
$email = "test@example.com";
if ($validator->validateEmail($email)) {
    echo "Email is valid.";
} else {
    echo "Email is not valid.";
}
