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



<?php
/**
 * fetch(): Fetches the next row from a result set. Returns an array containing the fetched row, or false if there are no more rows.
 */
$row = $stmt->fetch(PDO::FETCH_ASSOC);


/**
 * fetchAll(): Fetches all rows from a result set. Returns an array containing all of the remaining rows in the result set.
 */
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


/**
 * fetchColumn(): Fetches a single column from the next row of a result set.
 */
$columnValue = $stmt->fetchColumn();


/**
 * bindParam(): Binds a parameter to the specified variable name.
 */
$stmt->bindParam(':parameterName', $variable, PDO::PARAM_TYPE);


/**
 * bindValue(): Binds a value to a parameter.
 */
$stmt->bindValue(':parameterName', $value, PDO::PARAM_TYPE);


/**
 * rowCount(): Returns the number of rows affected by the last SQL statement.
 */
$rowCount = $stmt->rowCount();


?>

users
--------------
user_id (PK)
username
password
email
...other user details

carts
--------------
cart_id (PK)
user_id (FK to users.user_id)
status (active/inactive)
created_at
...other cart details

products
--------------
product_id (PK)
name
price
...other product details

cart_items
--------------
cart_item_id (PK)
cart_id (FK to carts.cart_id)
product_id (FK to products.product_id)
quantity
...other cart item details

addresses
--------------
address_id (PK)
user_id (FK to users.user_id)
type (billing/delivery)
street
city
country
zip
...other address details

payments
--------------
payment_id (PK)
cart_id (FK to carts.cart_id)
user_id (FK to users.user_id) 
amount
payment_type (bill/creditcard)
...other payment details





preg_match:

    Basic Characters:
        abc: Matches the exact characters 'abc'.

    Character Classes:
        [a-z]: Matches any lowercase letter.
        [A-Z]: Matches any uppercase letter.
        [0-9]: Matches any digit.

    Quantifiers:
        *: Matches 0 or more occurrences of the preceding character.
        +: Matches 1 or more occurrences of the preceding character.
        ?: Matches 0 or 1 occurrence of the preceding character.
        {n}: Matches exactly n occurrences of the preceding character.
        {n,}: Matches n or more occurrences of the preceding character.
        {n,m}: Matches between n and m occurrences of the preceding character.

    Anchors:
        ^: Matches the start of the string.
        $: Matches the end of the string.

    Escaping:
        \: Escapes a special character, allowing you to match it literally.

    Character Sets and Ranges:
        .: Matches any character except a newline.
        \d: Matches any digit (equivalent to [0-9]).
        \w: Matches any word character (alphanumeric + underscore).
        \s: Matches any whitespace character.
        \D, \W, \S: Negations of \d, \w, \s respectively.

    Groups:
        (): Groups together expressions.
        (?: ...): Non-capturing group.

    Alternation:
        |: Acts like a logical OR. Matches either the pattern on the left or the pattern on the right.

    Modifiers:
        i: Case-insensitive matching.
        m: Multi-line matching.
        u: Enables correct matching for Unicode.

    Assertions:
        (?= ...): Positive lookahead assertion.
        (?! ...): Negative lookahead assertion.




        [
	{
		"name": "localhost",
		// ip
		"host": "",
		"port": 21,
		// sftp = port 22
		"type": "ftp",
		"username": "",
		"password": "",
		"path": "/",
		"autosave": true,
		"confirm": true
	}
]