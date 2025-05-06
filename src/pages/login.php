<?php
session_start();

// Processamento do formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha']; // A senha não deve ser sanitizada para hash

    // Validações básicas
    if (empty($email) || empty($senha)) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Por favor, preencha todos os campos.'];
    } else {
        try {
            // Conexão com o banco de dados
            require_once 'db.php';
            
            // Prepara a consulta
            $stmt = $pdo->prepare("SELECT idUser, nome, senha FROM usuario WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            // Verifica se encontrou o usuário
            if ($stmt->rowCount() === 1) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Verifica a senha
                if (password_verify($senha, $usuario['senha'])) {
                    // Login bem-sucedido
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nome'] = $usuario['nome'];
                    $_SESSION['logado'] = true;
                    
                    // Redireciona para área restrita
                    header('Location: ../dashboard.php');
                    exit;
                } else {
                    $_SESSION['msg'] = ['type' => 'error', 'text' => 'Senha incorreta.'];
                }
            } else {
                $_SESSION['msg'] = ['type' => 'error', 'text' => 'E-mail não cadastrado.'];
            }
        } catch(PDOException $e) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Erro no sistema. Por favor, tente novamente.'];
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Erro: ' . $e->getMessage()];
        }
    }
} 

include '../../includes/header.php';
?>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card login-card">
                <div class="card-header bg-success text-white">
                    <h3 class="text-center mb-0">Login EcoTurismo</h3>
                </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['msg'])): ?>
                        <div class="alert alert-<?= $_SESSION['msg']['type'] ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['msg']['text'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['msg']); ?>
                    <?php endif; ?>
                    
                    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="senha">Senha:</label>
                            <input type="password" class="form-control" id="senha" name="senha" required>
                        </div>
                        
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="lembrar">
                            <label class="form-check-label" for="lembrar">Lembrar-me</label>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-block">Entrar</button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="recuperar_senha.php">Esqueci minha senha</a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    Não tem uma conta? <a href="register.php">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>