<?php
session_start();

// Processamento do formulário de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'];
    $confirmar_senha = $_POST['confirmar_senha'];

    // Validações
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Por favor, preencha todos os campos.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Por favor, insira um e-mail válido.'];
    } elseif ($senha !== $confirmar_senha) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'As senhas não coincidem.'];
    } elseif (strlen($senha) < 8) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'A senha deve ter pelo menos 8 caracteres.'];
    } elseif (!isset($_POST['tipoUser'])) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Selecione o tipo de usuário.'];
    } elseif (!isset($_POST['termos'])) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Você deve aceitar os termos de uso.'];
    } else {
        require_once 'db.php';
        
        try {
            // Verifica se o e-mail já existe
            $stmt = $pdo->prepare("SELECT idUser FROM usuario WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                $_SESSION['msg'] = ['type' => 'error', 'text' => 'Este e-mail já está cadastrado.'];
            } else {
                // Hash da senha
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                
                // Insere o novo usuário
                $stmt = $pdo->prepare("INSERT INTO usuario   (nome, email, senha, tipoUser) VALUES (:nome, :email, :senha, :tipoUser)");
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha_hash);
                $stmt->bindParam(':tipoUser', $_POST['tipoUser']);
                
                if ($stmt->execute()) {
                    $_SESSION['msg'] = ['type' => 'success', 'text' => 'Cadastro realizado com sucesso! Faça login para continuar.'];
                    header('Location: login.php');
                    exit;
                }
            }
        } catch(PDOException $e) {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Erro no banco de dados: ' . $e->getMessage()];
        }
    }
}

include '../../includes/header.php';
?>

<div class="container registro-container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card registro-card">
                <div class="card-header bg-success text-white">
                    <h3 class="text-center mb-0">Cadastre-se no EcoTurismo</h3>
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
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="nome">Nome completo:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="senha">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" minlength="8" required>
                                <small class="form-text text-muted">Mínimo 8 caracteres</small>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="confirmar_senha">Confirmar Senha:</label>
                                <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipoUser">Tipo de Usuário:</label>
                            <select class="form-control" id="tipoUser" name="tipoUser" required>
                                <option value="" disabled selected>Selecione...</option>
                                <option value="comum">Visitante</option>
                                <option value="admin">Administrador</option>
                        </div>
                        
                        <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    Já tem uma conta? <a href="login.php">Faça login</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Termos de Uso -->
<div class="modal fade" id="termosModal" tabindex="-1" role="dialog" aria-labelledby="termosModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termosModalLabel">Termos de Uso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Conteúdo dos termos de uso aqui...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>