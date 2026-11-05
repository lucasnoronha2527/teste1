<?php
// Command Injection: entrada do usuário vai direto para o shell
if (isset($_GET["host"])) {
    $host = $_GET["host"];
    echo "<pre>";
    system("ping -c 1 " . $host);
    echo "</pre>";
}
?>
<form method="GET">
  <input name="host" placeholder="Host para testar">
  <button>Ping</button>
</form>
