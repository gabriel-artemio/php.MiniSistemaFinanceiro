<?php
require_once('../config/db.php');

if ($_POST) {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['usuario'] = $email;
        header("Location: ../dashboard/index.php");
    } else {
        echo "Login inválido!";
    }
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="senha" placeholder="Senha"><br>
    <button type="submit">Entrar</button>
</form>