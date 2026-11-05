<?php
// Lista branca: só páginas previamente permitidas podem ser incluídas
$permitidas = ["home" => "home.php", "sobre" => "sobre.php", "contato" => "contato.php"];
$pagina = $_GET["p"] ?? "home";

if (!array_key_exists($pagina, $permitidas)) {
    http_response_code(404);
    exit("Página não encontrada.");
}
require __DIR__ . "/" . $permitidas[$pagina];
?>
