<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);   // hash fraco

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
    mysqli_query($conn, $sql);
    echo "Usuário cadastrado com sucesso!";
}
?>
<form method="POST">
  <input name="nome" placeholder="Nome">
  <input name="email" placeholder="E-mail">
  <input type="password" name="senha" placeholder="Senha">
  <button>Cadastrar</button>
</form>
