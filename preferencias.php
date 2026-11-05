<?php
// JSON não executa código ao ser lido, ao contrário de unserialize()
if (isset($_COOKIE["prefs"])) {
    $prefs = json_decode($_COOKIE["prefs"], true);
    $tema = is_array($prefs) ? ($prefs["tema"] ?? "claro") : "claro";
    $tema = in_array($tema, ["claro", "escuro"], true) ? $tema : "claro";
    echo "Tema: " . htmlspecialchars($tema, ENT_QUOTES, "UTF-8");
}
?>
