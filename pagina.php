<?php
$pagina = $_GET["p"] ?? "home";

// Cada caso inclui um arquivo fixo: a entrada do usuário nunca vira caminho
switch ($pagina) {
    case "home":
        require __DIR__ . "/home.php";
        break;
    case "sobre":
        require __DIR__ . "/sobre.php";
        break;
    case "contato":
        require __DIR__ . "/contato.php";
        break;
    default:
        http_response_code(404);
        echo "Página não encontrada.";
}
?>
