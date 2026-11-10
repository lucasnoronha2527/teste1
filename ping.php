<?php
if (isset($_GET["host"])) {
    $host = $_GET["host"];

    // 1) Valida o formato: só IP ou nome de domínio
    if (!filter_var($host, FILTER_VALIDATE_IP) &&
        !filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
        exit("Host inválido.");
    }

    // 2) Resolve o nome e bloqueia IPs privados/reservados (evita SSRF)
    $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);
    if (!filter_var($ip, FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        exit("Host não permitido.");
    }

    // 3) Teste de conexão feito pelo PHP, sem executar comandos do sistema
    $inicio = microtime(true);
    $conexao = @fsockopen($ip, 80, $errno, $errstr, 3);

    if ($conexao) {
        fclose($conexao);
        $ms = round((microtime(true) - $inicio) * 1000);
        echo "Host acessível (" . (int) $ms . " ms).";
    } else {
        echo "Host inacessível.";
    }
}
?>
<form method="GET">
  <input name="host" placeholder="Host para testar">
  <button>Testar conexão</button>
</form>
