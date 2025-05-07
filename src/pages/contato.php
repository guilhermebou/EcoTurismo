<?php 
// Inicia a sessão para mensagens de feedback
session_start();

// Processa o formulário se for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valida e sanitiza os dados
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $assunto = filter_input(INPUT_POST, 'assunto', FILTER_SANITIZE_STRING);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
    
    // Validação básica
    if (empty($nome) || empty($email) || empty($mensagem)) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Por favor, preencha todos os campos obrigatórios.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['msg'] = ['type' => 'error', 'text' => 'Por favor, insira um e-mail válido.'];
    } else {
        // Configurações do e-mail (substitua com seus dados)
        $to = 'contato@ecoturismo.com.br';
        $subject = "Contato do Site - " . ucfirst($assunto);
        $message = "
            <html>
            <head>
                <title>Contato do Site</title>
            </head>
            <body>
                <h2>Novo contato recebido</h2>
                <p><strong>Nome:</strong> {$nome}</p>
                <p><strong>E-mail:</strong> {$email}</p>
                <p><strong>Telefone:</strong> {$telefone}</p>
                <p><strong>Assunto:</strong> " . ucfirst($assunto) . "</p>
                <p><strong>Mensagem:</strong><br>" . nl2br($mensagem) . "</p>
            </body>
            </html>
        ";
        
        // Headers para e-mail HTML
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        $headers .= "From: {$nome} <{$email}>\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        
        // Envia o e-mail
        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['msg'] = ['type' => 'success', 'text' => 'Mensagem enviada com sucesso! Responderemos em breve.'];
        } else {
            $_SESSION['msg'] = ['type' => 'error', 'text' => 'Houve um erro ao enviar sua mensagem. Por favor, tente novamente mais tarde.'];
        }
    }
    
    // Redireciona para evitar reenvio ao atualizar a página
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

include '../../includes/header.php'; 
?>

<div class="container contact-page">
    <h1 class="text-center mb-4">Contato</h1>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="alert alert-<?= $_SESSION['msg']['type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['msg']['text'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['msg']); ?>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="contact-info">
                <h3><i class="fas fa-info-circle"></i> Informações de Contato</h3>
                <p>Estamos disponíveis para tirar suas dúvidas e receber suas sugestões.</p>
                
                <ul class="contact-list">
                    <li><i class="fas fa-phone"></i> (34) XXXX-XXXX</li>
                    <li><i class="fas fa-whatsapp"></i> (34) XXXX-XXXX</li>
                    <li><i class="fas fa-envelope"></i> contato@ecoturismo.com.br</li>
                    <li><i class="fas fa-map-marker-alt"></i> Monte Carmelo - MG</li>
                </ul>
                
                <div class="business-hours mt-4">
                    <h4><i class="far fa-clock"></i> Horário de Funcionamento:</h4>
                    <p>Segunda a Sexta: 08:00 - 18:00<br>
                    Sábado: 09:00 - 14:00<br>
                    Domingo: Fechado</p>
                </div>
                
                <div class="social-media mt-4">
                    <h4>Nos siga nas redes sociais:</h4>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/umpenoparque/" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="contact-form">
                <h3><i class="fas fa-paper-plane"></i> Envie uma mensagem</h3>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome: *</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail: *</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="tel" id="telefone" name="telefone" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label for="assunto">Assunto: *</label>
                        <select id="assunto" name="assunto" class="form-control" required>
                            <option value="" selected disabled>Selecione...</option>
                            <option value="duvida">Dúvida</option>
                            <option value="sugestao">Sugestão</option>
                            <option value="reclamacao">Reclamação</option>
                            <option value="elogio">Elogio</option>
                            <option value="reserva">Reserva</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="mensagem">Mensagem: *</label>
                        <textarea id="mensagem" name="mensagem" rows="5" class="form-control" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-paper-plane"></i> Enviar Mensagem
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <div class="map-section mt-5">
        <h3><i class="fas fa-map-marked-alt"></i> Onde estamos</h3>
        <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3778.092859377917!2d-47.516356599999995!3d-18.7493888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94a58700760763c5%3A0x8b6c8d81f4541ae5!2sParque%20da%20Matinha!5e0!3m2!1spt-BR!2sbr!4v1744241521724!5m2!1spt-BR!2sbr" 
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>