<?php 
session_start();
include '../../includes/header.php';
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
        $error = "Usuário ou senha incorretos.";
    }
}
?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2 class="auth-title">Login</h2>
        <?php if (isset($error)): ?>
            <div class="auth-message error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form class="auth-form" action="login.php" method="post">
            <div class="form-group">
                <label for="login">Usuário</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            
            <button type="submit" class="auth-btn">Entrar</button>
        </form>
        
        <div class="auth-divider">ou</div>
        
    
        
        <div class="auth-links">
            <a href="register.php">Criar nova conta</a>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>