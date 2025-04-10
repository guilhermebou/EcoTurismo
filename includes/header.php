<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoTurismo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/style.css">
    <style>
        /* Estilos adicionais para o menu */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .wrapper {
            display: flex;
            flex: 1;
        }
        
        .sidebar {
            width: 250px;
            background: linear-gradient(to bottom, #28a745, #218838);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }
        
        .nav-link {
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            border-left: 3px solid white;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <nav class="sidebar bg-success p-3 text-white">
            <h3 class="text-center mb-4">EcoTurismo</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="index.php" class="nav-link text-white"><i class="fas fa-home me-2"></i>Início</a></li>
                <li class="nav-item"><a href="sobre.php" class="nav-link text-white"><i class="fas fa-info-circle me-2"></i>Sobre</a></li>
                <li class="nav-item"><a href="rotas.php" class="nav-link text-white"><i class="fas fa-map-marked-alt me-2"></i>Rotas</a></li>
                <li class="nav-item"><a href="agendamento.php" class="nav-link text-white"><i class="far fa-calendar-alt me-2"></i>Agendamento</a></li>
                <li class="nav-item"><a href="acervo.php" class="nav-link text-white"><i class="fas fa-images me-2"></i>Acervo</a></li>
                <li class="nav-item"><a href="contato.php" class="nav-link text-white"><i class="fas fa-envelope me-2"></i>Fale Conosco</a></li>
            </ul>
            
            <div class="mt-4 pt-3 border-top border-light">
                <ul class="nav flex-column">
                    <li class="nav-item"><a href="login.php" class="nav-link text-white"><i class="fas fa-user-circle me-2"></i>Login</a></li>
                    <li class="nav-item"><a href="register.php" class="nav-link text-white"><i class="fas fa-user-plus me-2"></i>Cadastrar-se</a></li>
                    <li class="nav-item"><a href="logout.php" class="nav-link text-white"><i class="fas fa-sign-out-alt me-2"></i>Sair</a></li>
                </ul>
            </div>
        </nav>

        <main class="main-content">