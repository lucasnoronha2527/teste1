<?php
if (isset($_GET["host"])) {
    $host = $_GET["host"];

    // 1) Valida: só aceita IP ou nome de domínio válidos
    if (!filter_var($host, FILTER_VALIDATE_IP) &&
        !filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
        exit("Host inválido.");
    }

    // 2) proc_open com array de argumentos: o comando é executado
    //    diretamente, SEM passar por um shell, então não há injeção
    $descritores = [1 => ["pipe", "w"], 2 => ["pipe", "w"]];
    $proc = proc_open(["ping", "-c", "1", $host], $descritores, $pipes);

    if (is_resource($proc)) {
        $saida = stream_get_contents($pipes[1]);
        fclose($pipes[1]);
        fclose($pipes[2]);
        proc_close($proc);
        echo "<pre>" . htmlspecialchars($saida, ENT_QUOTES, "UTF-8") . "</pre>";
    }
}
?>
<form method="GET">
  <input name="host" placeholder="Host para testar">
  <button>Ping</button>
</form>
