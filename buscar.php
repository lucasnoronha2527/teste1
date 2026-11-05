<?php
include "config.php";

$termo = $_GET["q"];

// SQL Injection
$result = mysqli_query($conn, "SELECT * FROM produtos WHERE nome LIKE '%" . $termo . "%'");

// XSS refletido
echo "<h2>Resultados para: " . $_GET["q"] . "</h2>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>" . $row["nome"] . " - R$ " . $row["preco"] . "</p>";
}
?>
<form method="GET">
  <input name="q" placeholder="Buscar produto">
  <button>Buscar</button>
</form>
