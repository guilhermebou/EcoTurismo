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
    <title>Cadastro de Dados</title>
    <style>
        .mensagem { padding: 10px; margin: 15px 0; border-radius: 5px; }
        .sucesso { background-color: #d4edda; color: #155724; }
        .erro    { background-color: #f8d7da; color: #721c24; }
    </style>
    <script>
        function mostrarCampos() {
            const categoria = document.querySelector('[name="categoria"]').value;
            document.getElementById('form-acervo').style.display = categoria === 'Acervo' ? 'block' : 'none';
            document.getElementById('form-rota').style.display = categoria === 'Rota' ? 'block' : 'none';
            document.getElementById('form-nascente').style.display = categoria === 'Nascente' ? 'block' : 'none';
            document.getElementById('form-flora').style.display = categoria === 'Flora' ? 'block' : 'none';
            document.getElementById('form-fauna').style.display = categoria === 'Fauna' ? 'block' : 'none';
        }
    </script>
</head>
<body onload="mostrarCampos()">
    <h2>Cadastro de Dados</h2>

    <?php if ($mensagem): ?>
        <div class="mensagem <?= $tipo_mensagem ?>">
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">
        <label>Categoria:</label>
        <select name="categoria" required onchange="mostrarCampos()">
            <option value="">Selecione</option>
            <option value="Acervo" <?= ($_POST['categoria'] ?? '') === 'Acervo' ? 'selected' : '' ?>>Acervo</option>
            <option value="Rota" <?= ($_POST['categoria'] ?? '') === 'Rota' ? 'selected' : '' ?>>Rota</option>
            <option value="Nascente" <?= ($_POST['categoria'] ?? '') === 'Nascente' ? 'selected' : '' ?>>Nascente</option>
            <option value="Flora" <?= ($_POST['categoria'] ?? '') === 'Flora' ? 'selected' : '' ?>>Flora</option>
            <option value="Fauna" <?= ($_POST['categoria'] ?? '') === 'Fauna' ? 'selected' : '' ?>>Fauna</option>
        </select><br><br>

        <div id="form-acervo" style="display:none;">
            <label>Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>"><br>

            <label>Autores:</label>
            <input type="text" name="autores" value="<?= htmlspecialchars($_POST['autores'] ?? '') ?>"><br>

            <label>Resumo:</label><br>
            <textarea name="resumo" rows="5" cols="40"><?= htmlspecialchars($_POST['resumo'] ?? '') ?></textarea><br>

            <label>Data da publicação:</label>
            <input type="date" name="data_publicacao" value="<?= htmlspecialchars($_POST['data_publicacao'] ?? '') ?>"><br>

            <label>Arquivo:</label>
            <input type="file" name="arquivo" accept=".pdf,.doc,.docx,.txt"><br>

            <label>Link:</label>
            <input type="url" name="link" value="<?= htmlspecialchars($_POST['link'] ?? '') ?>"><br>
        </div>

        <div id="form-rota" style="display:none;">
            <label>ID da Rota:</label>
            <input type="text" name="rota_id" value="<?= htmlspecialchars($_POST['rota_id'] ?? '') ?>"><br>
        </div>

        <div id="form-nascente" style="display:none;">
            <label>Nome:</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>"><br>

            <label>Latitude:</label>
            <input type="text" name="latitude" value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>"><br>

            <label>Longitude:</label>
            <input type="text" name="longitude" value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>"><br>

            <label>Qualidade da água:</label>
            <input type="text" name="qualidade" value="<?= htmlspecialchars($_POST['qualidade'] ?? '') ?>"><br>

            <label>Vazão:</label>
            <input type="text" name="vazao" value="<?= htmlspecialchars($_POST['vazao'] ?? '') ?>"><br>

            <label>Descrição:</label>
            <input type="text" name="descric" value="<?= htmlspecialchars($_POST['descric'] ?? '') ?>"><br>
        </div>

        <div id="form-flora" style="display:none;">
            <label>Nome Cientifico:</label>
            <input type="text" name="nome_cien" value="<?= htmlspecialchars($_POST['nome_cien'] ?? '') ?>"><br>

            <label>Nome Popular:</label>
            <input type="text" name="nome_pop" value="<?= htmlspecialchars($_POST['nome_pop'] ?? '') ?>"><br>

            <label>Latitude:</label>
            <input type="text" name="latitude" value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>"><br>

            <label>Longitude:</label>
            <input type="text" name="longitude" value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>"><br>

            <label>Estado de Conservação:</label>
            <input type="text" name="estado" value="<?= htmlspecialchars($_POST['estado'] ?? '') ?>"><br>

            <label>Descrição:</label>
            <input type="text" name="descric" value="<?= htmlspecialchars($_POST['descric'] ?? '') ?>"><br>
        </div>

        <div id="form-fauna" style="display:none;">
            <label>Espécie:</label>
            <input type="text" name="especie" value="<?= htmlspecialchars($_POST['especie'] ?? '') ?>"><br>

            <label>Grupo:</label>
            <input type="text" name="grupo" value="<?= htmlspecialchars($_POST['grupo'] ?? '') ?>"><br>

            <label>Latitude:</label>
            <input type="text" name="latitude" value="<?= htmlspecialchars($_POST['latitude'] ?? '') ?>"><br>

            <label>Longitude:</label>
            <input type="text" name="longitude" value="<?= htmlspecialchars($_POST['longitude'] ?? '') ?>"><br>

            <label>Descrição:</label>
            <input type="text" name="descric" value="<?= htmlspecialchars($_POST['descric'] ?? '') ?>"><br>
        </div>

        <br><button type="submit">Cadastrar</button>
    </form>

    <?php if (!empty($_SESSION['login'])): ?>
        <p><a href="logout.php">Sair (<?= htmlspecialchars($_SESSION['login']) ?>)</a></p>
    <?php else: ?>
        <p style="color:red;">
            Você não está logado.
            <a href="login.php">Clique aqui para logar.</a>
        </p>
    <?php endif; ?>
</body>
</html>

<?php include '../../includes/footer.php'; ?>
