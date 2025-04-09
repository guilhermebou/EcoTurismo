<?php include '../../includes/header.php'; ?>
<?php
session_start();

// Exibe todos os erros
ini_set('display_errors', 1);
error_reporting(E_ALL);


// Conexão com o banco
require 'db.php';

// Garante que o PDO lance exceções e use prepared statements nativos
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$mensagem    = "";
$tipo_mensagem = ""; // 'sucesso' ou 'erro'

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // NÃO redireciona — apenas registra erro se não estiver logado
    if (empty($_SESSION['login'])) {
        $mensagem = "Você precisa estar logado para cadastrar.";
        $tipo_mensagem = "erro";
    } else {
        // Captura dados do formulário
        $categoria       = $_POST["categoria"];
        $titulo          = trim($_POST["titulo"]);
        $autores         = trim($_POST["autores"]);
        $resumo          = trim($_POST["resumo"]);
        $data_publicacao = $_POST["data_publicacao"];
        $link            = trim($_POST["link"]);

        // Upload do arquivo
        $arquivo_nome = $_FILES['arquivo']['name'] ?? '';
        $arquivo_tmp  = $_FILES['arquivo']['tmp_name'] ?? '';
        $destino      = __DIR__ . '/../../articles/' . basename($arquivo_nome);

        if ($arquivo_nome === "" || !is_uploaded_file($arquivo_tmp)) {
            $mensagem = "Nenhum arquivo enviado.";
            $tipo_mensagem = "erro";
        }
        elseif (!move_uploaded_file($arquivo_tmp, $destino)) {
            $mensagem = "Falha ao mover o arquivo para 'articles/'. Verifique permissões.";
            $tipo_mensagem = "erro";
        }
        else {
            // Tenta inserir no banco
            try {
                $sql = "INSERT INTO acervo
                        (categoria, titulo, autores, resumo, data_publicacao, arquivo, link)
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
                    // Limpa dados para não repostar
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
</head>
<body>
    <h2>Cadastro de Dados</h2>

    <?php if ($mensagem): ?>
        <div class="mensagem <?= $tipo_mensagem ?>">
            <?= htmlspecialchars($mensagem) ?>
        </div>
    <?php endif; ?>

    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>"
          method="post"
          enctype="multipart/form-data"
    >
        <label>Categoria:</label>
        <select name="categoria" required>
            <option value="Acervo"
                <?= (($_POST['categoria'] ?? '') === 'Acervo') ? 'selected' : '' ?>>
                Acervo
            </option>
        </select><br><br>

        <label>Título:</label>
        <input type="text" name="titulo"
               value="<?= htmlspecialchars($_POST['titulo'] ?? '') ?>"
               required><br>

        <label>Autores:</label>
        <input type="text" name="autores"
               value="<?= htmlspecialchars($_POST['autores'] ?? '') ?>"
               required><br>

        <label>Resumo:</label><br>
        <textarea name="resumo" rows="5" cols="40" required><?=
            htmlspecialchars($_POST['resumo'] ?? '') ?></textarea><br>

        <label>Data da publicação:</label>
        <input type="date" name="data_publicacao"
               value="<?= htmlspecialchars($_POST['data_publicacao'] ?? '') ?>"
               required><br>

        <label>Arquivo:</label>
        <input type="file" name="arquivo" accept=".pdf,.doc,.docx,.txt" required><br>

        <label>Link:</label>
        <input type="url" name="link"
               value="<?= htmlspecialchars($_POST['link'] ?? '') ?>"><br><br>

        <button type="submit">Cadastrar</button>
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
