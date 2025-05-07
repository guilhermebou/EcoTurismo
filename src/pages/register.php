<?php 
session_start();
include '../../includes/header.php';
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = trim($_POST["login"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    try {
        $query = $pdo->prepare("INSERT INTO usuarios1 (login, senha) VALUES (?, ?)");
        $query->execute([$login, $senha]);

        $_SESSION['success'] = "Cadastro realizado com sucesso!";
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $error = "Erro no cadastro: " . $e->getMessage();
    }
}
?>

<div class="auth-wrapper">
    <div class="auth-container">
        <h2 class="auth-title">Cadastrar-se</h2>
        
        <?php if (isset($error)): ?>
            <div class="auth-message error">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="auth-message success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <form class="auth-form" action="register.php" method="post">
            <div class="form-group">
                <label for="login">Usuário</label>
                <input type="text" class="form-control" id="login" name="login" required>
            </div>
            
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
                <small class="text-muted">Mínimo de 8 caracteres</small>
            </div>
            
            <div class="form-group">
                <label for="confirmar_senha">Confirmar Senha</label>
                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            
            <button type="submit" class="auth-btn">Cadastrar</button>
        </form>
        
        <div class="auth-divider">ou</div>
        
        <div class="auth-links">
            Já tem uma conta? <a href="login.php">Faça login</a>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>