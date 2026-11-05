<?php
require "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = trim($_POST["nome"] ?? "");
    $email = filter_var($_POST["email"] ?? "", FILTER_VALIDATE_EMAIL);
    $senha = $_POST["senha"] ?? "";

    if ($nome === "" || !$email || strlen($senha) < 8) {
        exit("Dados inválidos.");
    }

    // password_hash usa bcrypt com salt automático
    $hash = password_hash($senha, PASSWORD_DEFAULT);

    // Prepared statement evita SQL Injection
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $hash);
    $stmt->execute();
    echo "Usuário cadastrado com sucesso!";
}
?>
<form method="POST">
  <input name="nome" placeholder="Nome">
  <input name="email" placeholder="E-mail">
  <input type="password" name="senha" placeholder="Senha">
  <button>Cadastrar</button>
</form>
