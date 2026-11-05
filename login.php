<?php
require "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();

    // password_verify compara a senha com o hash bcrypt
    if ($row && password_verify($senha, $row["senha"])) {
        session_regenerate_id(true);
        $_SESSION["usuario"] = $email;
        // htmlspecialchars evita XSS
        echo "Bem-vindo, " . htmlspecialchars($email, ENT_QUOTES, "UTF-8");
    } else {
        echo "Login inválido";
    }
}
?>
<form method="POST">
  <input name="email" placeholder="E-mail">
  <input type="password" name="senha" placeholder="Senha">
  <button>Entrar</button>
</form>
