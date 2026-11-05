<?php
require "config.php";

$termo = $_GET["q"] ?? "";
$like  = "%" . $termo . "%";

$stmt = $conn->prepare("SELECT nome, preco FROM produtos WHERE nome LIKE ?");
$stmt->bind_param("s", $like);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Resultados para: " . htmlspecialchars($termo, ENT_QUOTES, "UTF-8") . "</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<p>" . htmlspecialchars($row["nome"], ENT_QUOTES, "UTF-8")
       . " - R$ " . htmlspecialchars($row["preco"], ENT_QUOTES, "UTF-8") . "</p>";
}
?>
<form method="GET">
  <input name="q" placeholder="Buscar produto">
  <button>Buscar</button>
</form>
