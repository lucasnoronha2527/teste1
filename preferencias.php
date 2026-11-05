<?php
// Deserialização insegura: dados do cookie são desserializados
if (isset($_COOKIE["prefs"])) {
    $prefs = unserialize($_COOKIE["prefs"]);
    echo "Tema: " . $prefs["tema"];
}
?>
