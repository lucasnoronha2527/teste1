<?php
if (isset($_GET["host"])) {
    $host = $_GET["host"];

    // Valida: só aceita IP ou nome de domínio válidos
    if (!filter_var($host, FILTER_VALIDATE_IP) &&
        !filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
        exit("Host inválido.");
    }

    // escapeshellarg neutraliza caracteres especiais do shell
    $saida = [];
    exec("ping -c 1 " . escapeshellarg($host), $saida);
    echo "<pre>" . htmlspecialchars(implode("\n", $saida), ENT_QUOTES, "UTF-8") . "</pre>";
}
?>
<form method="GET">
  <input name="host" placeholder="Host para testar">
  <button>Ping</button>
</form>
