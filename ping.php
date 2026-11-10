<?php
// Lista fixa de destinos permitidos (allowlist)
if (isset($_GET["alvo"])) {
    // Cada caso usa um endereço FIXO: a entrada do usuário
    // só escolhe a opção e nunca vira o destino da conexão
    switch ($_GET["alvo"]) {
        case "google":
            $destino = "www.google.com";
            break;
        case "cloudflare":
            $destino = "1.1.1.1";
            break;
        case "github":
            $destino = "github.com";
            break;
        default:
            exit("Destino não permitido.");
    }

    $inicio = microtime(true);
    $conexao = @fsockopen($destino, 80, $errno, $errstr, 3);

    if ($conexao) {
        fclose($conexao);
        $ms = round((microtime(true) - $inicio) * 1000);
        echo "Destino acessível (" . (int) $ms . " ms).";
    } else {
        echo "Destino inacessível.";
    }
}
?>
<form method="GET">
  <select name="alvo">
    <option value="google">Google</option>
    <option value="cloudflare">Cloudflare</option>
    <option value="github">GitHub</option>
  </select>
  <button>Testar conexão</button>
</form>
