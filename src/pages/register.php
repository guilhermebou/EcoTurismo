<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["login"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    try {
        $query = $pdo->prepare("INSERT INTO usuarios (login, senha) VALUES (?, ?)");
        $query->execute([$login, $senha]);

        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $error = "ERRO no cadastro: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form action="register.php" method="post">
        <label>Usuario:</label>
        <input type="text" name="login" required><br>

        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <button type="submit">Cadastrar</button>
    </form>
    <p><a href="login.php">Login</a></p>
</body>
</html>
