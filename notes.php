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
*** SQL Injection !!!!!!! ABSICHERN
*** XSS: Cross Site Scripting !!!!!!! ABSICHERN
<script>alert('XSS');</script>

TODO: Orders auslesen aus dem WebShop




APIS:

** JSON
** XML
** CSV



Filezilla: sftp://ip username:lnux pw


start project:
1. register
2. login
3. Raussuchen was keine FK hat >> die zu erst machen




SQL

many to many relation
kardinalitaeten tauschen fuer zwischentabellen





1. **SELECT - Retrieving Data:**
   - `SELECT` is used to retrieve data from one or more tables in a database.

2. **FROM - Specifying Tables:**
   - `FROM` is used to specify the table or tables from which you want to retrieve data.

3. **WHERE - Filtering Data:**
   - `WHERE` is used to filter data based on specified conditions.

4. **GROUP BY - Grouping Data:**
   - `GROUP BY` is used to group rows with similar values in one or more columns.

5. **HAVING - Filtering Groups:**
   - `HAVING` is used to filter groups of data created by the `GROUP BY` clause.

6. **ORDER BY - Sorting Data:**
   - `ORDER BY` is used to sort the result set in ascending (ASC) or descending (DESC) order.

7. **JOIN - Combining Tables:**
   - `JOIN` is used to combine rows from two or more tables based on a related column between them.

8. **LEFT JOIN - All from Left Table:**
   - `LEFT JOIN` returns all rows from the left table and the matching rows from the right table.

9. **INNER JOIN - Intersection:**
   - `INNER JOIN` returns only the rows that have matches in both joined tables.

10. **COUNT() - Counting Rows:**
    - `COUNT()` is an aggregate function that counts the number of rows in a result set.

11. **SUM() - Adding Values:**
    - `SUM()` is an aggregate function that calculates the sum of values in a numeric column.

12. **AVG() - Finding Average:**
    - `AVG()` is an aggregate function that calculates the average (mean) value of a numeric column.

13. **MAX() - Maximum Value:**
    - `MAX()` is an aggregate function that returns the maximum value in a column.

14. **MIN() - Minimum Value:**
    - `MIN()` is an aggregate function that returns the minimum value in a column.

15. **LIKE - Pattern Matching:**
    - `LIKE` is used for pattern matching in text fields to find similar values based on patterns.

16. **AS - Alias Names:**
    - `AS` is used to assign an alias or a shorter name to a table or column for improved readability.

17. **DISTINCT - Unique Values:**
    - `DISTINCT` is used to retrieve only unique values, removing duplicates from the result set.


SELECT p.product_name, SUM(od.quantity * p.price) as total_sales
FROM products AS p
JOIN order_details AS od ON p.product_id = od.product_id
JOIN orders AS o ON od.order_id = o.order_id
WHERE p.category_id = 'your_category_id'
AND o.order_date >= '2023-01-01' AND o.order_date <= '2023-12-31'
GROUP BY p.product_name
HAVING total_sales > 1000
ORDER BY total_sales DESC
LIMIT 10;

