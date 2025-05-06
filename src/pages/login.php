<?php include '../../includes/header.php'; ?>
<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["login"]);
    $senha = $_POST["senha"];

    $query = $pdo->prepare("SELECT * FROM usuarios1 WHERE login = ?");
    $query->execute([$login]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user["senha"])) {
        $_SESSION['login'] = $user['login'];
        header("Location: auxiliar.php");
        exit();
    } else {
        $error = "usuario ou senha incorreto.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<meta charset="UTF-8">

<body>
    <h2>Login</h2>
    <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form action="login.php" method="post">
        <label>Usuario:</label>
        <input type="text" name="login" required><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="register.php">Cadastro</a></p>
    <p><a href="listar.php">Listar Usuarios</a></p>




</body>
</html>

<?php include '../../includes/footer.php'; ?>
