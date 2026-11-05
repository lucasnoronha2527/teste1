<?php
// File Inclusion / Path Traversal: nome do arquivo vem do usuário
$pagina = $_GET["p"];
include($pagina . ".php");
?>
