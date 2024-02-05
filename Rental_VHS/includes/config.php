<?php
// Établir la connection avec la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'florent');
define('DB_PASS', '123456789');
define('DB_NAME', 'VHS');

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>

<!-- Config.php -->