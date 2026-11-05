<?php
include "config.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);

    // SQL Injection: entrada do usuário concatenada na query
    $sql = "SELECT * FROM usuarios WHERE email = '" . $email . "' AND senha = '" . $senha . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["usuario"] = $email;
        echo "Bem-vindo, " . $_POST["email"];   // XSS refletido
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
