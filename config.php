<?php
// Credenciais vêm de variáveis de ambiente, nunca ficam no código
$host     = getenv("DB_HOST") ?: "localhost";
$user     = getenv("DB_USER") ?: "app_user";
$password = getenv("DB_PASSWORD");
$dbname   = getenv("DB_NAME") ?: "loja";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $user, $password, $dbname);
$conn->set_charset("utf8mb4");
?>
