<?php
require 'config.php';
$conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>