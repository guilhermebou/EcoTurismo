<?php include '../../includes/header.php'; ?>
<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'db.php';

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$mensagem = "";
$tipo_mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_SESSION['login'])) {
        $mensagem = "Você precisa estar logado para cadastrar.";
        $tipo_mensagem = "erro";
    } else {
        $categoria = $_POST["categoria"];

        if ($categoria === "Acervo") {
            $titulo = trim($_POST["titulo"]);
            $autores = trim($_POST["autores"]);
            $resumo = trim($_POST["resumo"]);
            $data_publicacao = $_POST["data_publicacao"];
            $link = trim($_POST["link"]);

            $arquivo_nome = $_FILES['arquivo']['name'] ?? '';
            $arquivo_tmp  = $_FILES['arquivo']['tmp_name'] ?? '';
            $destino      = __DIR__ . '/../../articles/' . basename($arquivo_nome);

            if ($arquivo_nome === "" || !is_uploaded_file($arquivo_tmp)) {
                $mensagem = "Nenhum arquivo enviado.";
                $tipo_mensagem = "erro";
            } elseif (!move_uploaded_file($arquivo_tmp, $destino)) {
                $mensagem = "Falha ao mover o arquivo.";
                $tipo_mensagem = "erro";
            } else {
                try {
                    $sql = "INSERT INTO acervo (categoria, titulo, autores, resumo, data_publicacao, arquivo, link)
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $ok = $stmt->execute([
                        $categoria,
                        $titulo,
                        $autores,
                        $resumo,
                        $data_publicacao,
                        $arquivo_nome,
                        $link
                    ]);
                    if ($ok) {
                        $mensagem = "Item cadastrado com sucesso!";
                        $tipo_mensagem = "sucesso";
                        $_POST = [];
                    } else {
                        $mensagem = "Erro ao inserir no banco.";
                        $tipo_mensagem = "erro";
                    }
                } catch (PDOException $e) {
                    $mensagem = "Erro no banco: " . $e->getMessage();
                    $tipo_mensagem = "erro";
                }
            }
        } elseif ($categoria === "Rota") {
            $rota_id = trim($_POST["rota_id"]);
            try {
                $sql = "INSERT INTO rota (id) VALUES (?)";
                $stmt = $pdo->prepare($sql);
                $ok = $stmt->execute([$rota_id]);

                if ($ok) {
                    $mensagem = "Rota cadastrada com sucesso!";
                    $tipo_mensagem = "sucesso";
                    $_POST = [];
                } else {
                    $mensagem = "Erro ao inserir rota.";
                    $tipo_mensagem = "erro";
                }
            } catch (PDOException $e) {
                $mensagem = "Erro no banco: " . $e->getMessage();
                $tipo_mensagem = "erro";
            }

        } elseif ($categoria === "Nascente") {
            $nome = trim($_POST["nome"]);
            $latitude = trim($_POST["latitude"]);
            $longitude = trim($_POST["longitude"]);
            $qualidade = trim($_POST["qualidade"]);
            $vazao = trim($_POST["vazao"]);
            $descric = trim($_POST["descric"]);

            try {
                $sql = "INSERT INTO nascente (nome, latitude, longitude, qualidade_agua, vazao, descricao)
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $ok = $stmt->execute([$nome, $latitude, $longitude, $qualidade, $vazao, $descric]);

                if ($ok) {
                    $mensagem = "Nascente cadastrada com sucesso!";
                    $tipo_mensagem = "sucesso";
                    $_POST = [];
                } else {
                    $mensagem = "Erro ao inserir nascente.";
                    $tipo_mensagem = "erro";
                }
            } catch (PDOException $e) {
                $mensagem = "Erro no banco: " . $e->getMessage();
                $tipo_mensagem = "erro";
            }
        }elseif ($categoria === "Flora") {
            $nomec = trim($_POST["nome_cien"]);
            $nomep = trim($_POST["nome_pop"]);
            $latitude = trim($_POST["latitude"]);
            $longitude = trim($_POST["longitude"]);
            $estado = trim($_POST["estado"]);
            $descric = trim($_POST["descric"]);

            try {
                $sql = "INSERT INTO flora (nomec, nomep, latitude, longitude, estado, descricao)
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $ok = $stmt->execute([$nomec, $nomep, $latitude, $longitude, $estado, $descric]);

                if ($ok) {
                    $mensagem = "Flora cadastrada com sucesso!";
                    $tipo_mensagem = "sucesso";
                    $_POST = [];
                } else {
                    $mensagem = "Erro ao inserir Flora.";
                    $tipo_mensagem = "erro";
                }
            } catch (PDOException $e) {
                $mensagem = "Erro no banco: " . $e->getMessage();
                $tipo_mensagem = "erro";
            }
        }elseif ($categoria === "Fauna") {
            $especie = trim($_POST["especie"]);
            $grupo = trim($_POST["grupo"]);
            $latitude = trim($_POST["latitude"]);
            $longitude = trim($_POST["longitude"]);
            $descric = trim($_POST["descric"]);

            try {
                $sql = "INSERT INTO fauna (especie, grupo, latitude, longitude, descricao)
                        VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $ok = $stmt->execute([$especie, $grupo, $latitude, $longitude, $descric]);

                if ($ok) {
                    $mensagem = "Fauna cadastrada com sucesso!";
                    $tipo_mensagem = "sucesso";
                    $_POST = [];
                } else {
                    $mensagem = "Erro ao inserir Fauna.";
                    $tipo_mensagem = "erro";
                }
            } catch (PDOException $e) {
                $mensagem = "Erro no banco: " . $e->getMessage();
                $tipo_mensagem = "erro";
            }
        }

    }
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Dados - EcoTurismo</title>
    <link rel="stylesheet" href="../../CSS/style.css">
    <style>
        .cadastro-container {
            max-width: 1000px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .cadastro-container h2 {
            color: #28a745;
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 700;
            border-bottom: 2px solid #28a745;
            padding-bottom: 0.5rem;
        }

        /* Mensagens */
        .mensagem {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 5px;
            font-weight: 500;
            text-align: center;
        }

        .sucesso {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Formulário principal */
        .cadastro-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Seletor de categoria */
        .categoria-selector {
            margin-bottom: 1.5rem;
        }

        .categoria-selector label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #495057;
        }

        .categoria-selector select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .categoria-selector select:focus {
            border-color: #28a745;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        /* Formulários específicos */
        .form-section {
            display: none;
            padding: 1.5rem;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Campos do formulário */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #28a745;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        /* Botão de envio */
        .submit-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            width: 100%;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        /* Link de logout */
        .logout-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .logout-link a {
            color: #28a745;
            text-decoration: none;
            font-weight: 500;
        }

        .logout-link a:hover {
            text-decoration: underline;
        }

        /* Mensagem de não logado */
        .not-logged {
            text-align: center;
            color: #dc3545;
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #f8d7da;
            border-radius: 5px;
        }

        .not-logged a {
            color: #dc3545;
            font-weight: 500;
            text-decoration: none;
        }

        .not-logged a:hover {
            text-decoration: underline;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .cadastro-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .form-section {
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .cadastro-container {
                padding: 1rem;
            }
            
            .form-group {
                margin-bottom: 1rem;
            }
        }
    </style>
    <script>
        function mostrarCampos() {
            const categoria = document.querySelector('[name="categoria"]').value;
            // Esconde todas as seções primeiro
            document.querySelectorAll('.form-section').forEach(section => {
                section.classList.remove('active');
            });
            // Mostra apenas a seção relevante
            if (categoria) {
                document.getElementById(`form-${categoria.toLowerCase()}`).classList.add('active');
            }
        }
    </script>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro de Dados</h2>

        <?php if ($mensagem): ?>
            <div class="mensagem <?= $tipo_mensagem ?>">
                <?= htmlspecialchars($mensagem) ?>
            </div>
        <?php endif; ?>

        <form class="cadastro-form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
            <div class="categoria-selector">
                <label for="categoria">Categoria:</label>
                <select name="categoria" id="categoria" required onchange="mostrarCampos()">
                    <option value="">Selecione uma categoria</option>
                    <option value="Acervo" <?= ($_POST['categoria'] ?? '') === 'Acervo' ? 'selected' : '' ?>>Acervo</option>
                    <option value="Rota" <?= ($_POST['categoria'] ?? '') === 'Rota' ? 'selected' : '' ?>>Rota</option>
                    <option value="Nascente" <?= ($_POST['categoria'] ?? '') === 'Nascente' ? 'selected' : '' ?>>Nascente</option>
                    <option value="Flora" <?= ($_POST['categoria'] ?? '') === 'Flora' ? 'selected' : '' ?>>Flora</option>
                    <option value="Fauna" <?= ($_POST['categoria'] ?? '') === 'Fauna' ? 'selected' : '' ?>>Fauna</option>
                </select>
            </div>

            <!-- Formulário para Acervo -->
            <div id="form-acervo" class="form-section">
                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="autores">Autores:</label>
                    <input type="text" id="autores" name="autores" class="form-control" value="<?= htmlspecialchars($_POST['autores'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="resumo">Resumo:</label>
                    <textarea id="resumo" name="resumo" class="form-control" rows="5"><?= htmlspecialchars($_POST['resumo'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="data_publicacao">Data da publicação:</label>
                    <input type="date" id="data_publicacao" name="data_publicacao" class="form-control" value="<?= htmlspecialchars($_POST['data_publicacao'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="arquivo">Arquivo (PDF, DOC, TXT):</label>
                    <input type="file" id="arquivo" name="arquivo" class="form-control" accept=".pdf,.doc,.docx,.txt">
                </div>

                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="url" id="link" name="link" class="form-control" value="<?= htmlspecialchars($_POST['link'] ?? '') ?>">
                </div>
            </div>

            <!-- Formulário para Rota -->
            <div id="form-rota" class="form-section">
                <div class="form-group">
                    <label for="rota_id">ID da Rota:</label>
                    <input type="text" id="rota_id" name="rota_id" class="form-control" value="<?= htmlspecialchars($_POST['rota_id'] ?? '') ?>">
                </div>
            </div>

            <!-- Formulário para Nascente -->
            <div id="form-nascente" class="form-section">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" class="form-control" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" class="form-control" value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="qualidade">Qualidade da água:</label>
                    <input type="text" id="qualidade" name="qualidade" class="form-control" value="<?= htmlspecialchars($_POST['qualidade'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="vazao">Vazão:</label>
                    <input type="text" id="vazao" name="vazao" class="form-control" value="<?= htmlspecialchars($_POST['vazao'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="descric">Descrição:</label>
                    <input type="text" id="descric" name="descric" class="form-control" value="<?= htmlspecialchars($_POST['descric'] ?? '') ?>">
                </div>
            </div>

            <!-- Formulário para Flora -->
            <div id="form-flora" class="form-section">
                <div class="form-group">
                    <label for="nome_cien">Nome Científico:</label>
                    <input type="text" id="nome_cien" name="nome_cien" class="form-control" value="<?= htmlspecialchars($_POST['nome_cien'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="nome_pop">Nome Popular:</label>
                    <input type="text" id="nome_pop" name="nome_pop" class="form-control" value="<?= htmlspecialchars($_POST['nome_pop'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" class="form-control" value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="estado">Estado de Conservação:</label>
                    <input type="text" id="estado" name="estado" class="form-control" value="<?= htmlspecialchars($_POST['estado'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="descric">Descrição:</label>
                    <input type="text" id="descric" name="descric" class="form-control" value="<?= htmlspecialchars($_POST['descric'] ?? '') ?>">
                </div>
            </div>

            <!-- Formulário para Fauna -->
            <div id="form-fauna" class="form-section">
                <div class="form-group">
                    <label for="especie">Espécie:</label>
                    <input type="text" id="especie" name="especie" class="form-control" value="<?= htmlspecialchars($_POST['especie'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="grupo">Grupo:</label>
                    <input type="text" id="grupo" name="grupo" class="form-control" value="<?= htmlspecialchars($_POST['grupo'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" class="form-control" value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="longitude">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" class="form-control" value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>">
                </div>

                <div class="form-group">
                    <label for="descric">Descrição:</label>
                    <input type="text" id="descric" name="descric" class="form-control" value="<?= htmlspecialchars($_POST['descric'] ?? '') ?>">
                </div>
            </div>

            <button type="submit" class="submit-btn">Cadastrar</button>
        </form>

        <?php if (!empty($_SESSION['login'])): ?>
            <div class="logout-link">
                Você está logado como <strong><?= htmlspecialchars($_SESSION['login']) ?></strong> | 
                <a href="logout.php">Sair</a>
            </div>
        <?php else: ?>
            <div class="not-logged">
                <p>Você não está logado. <a href="login.php">Clique aqui para fazer login</a></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php include '../../includes/footer.php'; ?>