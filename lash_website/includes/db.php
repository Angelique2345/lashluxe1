<?php
// includes/db.php
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = ''; // set your MySQL password
$DB_NAME = 'lash_luxe';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_error) {
    die('DB Connection failed: ' . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
