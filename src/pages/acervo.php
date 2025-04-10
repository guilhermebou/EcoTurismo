<?php
require 'db.php';
include '../../includes/header.php';

try {
    $query = $pdo->query("SELECT * FROM acervo ORDER BY data_publi DESC");
    $acervos = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<p style='color: red;'>Erro ao acessar o banco de dados: " . $e->getMessage() . "</p>";
    $acervos = [];
}
?>

<div class="container">
    <h2>Acervo</h2>
    <p>Descubra as produções cientificas do Parque da Matinha.</p>

    <a href="https://scholar.google.com.br/scholar?hl=pt-BR&as_sdt=0%2C5&q=parque+da+matinha+monte+carmelo&btnG=&oq=" target="_blank">
        Ver resultados no Google Acadêmico
    </a>

    <?php if (count($acervos) > 0): ?>
        <?php foreach ($acervos as $item): ?>
            <div style="border: 1px solid #ccc; padding: 15px; margin: 20px 0; border-radius: 8px;">
                <h3><?= htmlspecialchars($item['titulo']) ?></h3>
                <p><strong>Autores:</strong> <?= htmlspecialchars($item['autores']) ?></p>
                <p><strong>Data de Publicação:</strong> <?= date("d/m/Y", strtotime($item['data_publicacao'])) ?></p>
                <p><strong>Resumo:</strong><br> <?= nl2br(htmlspecialchars($item['resumo'])) ?></p>

                <?php if (!empty($item['link'])): ?>
                    <p><strong>Link para acesso:</strong>
                        <a href="<?= htmlspecialchars($item['link']) ?>" target="_blank"><?= htmlspecialchars($item['link']) ?></a>
                    </p>
                <?php endif; ?>

                <?php if (!empty($item['arquivo'])): ?>
                    <iframe src="../../articles/<?= htmlspecialchars($item['arquivo']) ?>" width="100%" height="600px" style="border: 1px solid #aaa;"></iframe>
                <?php else: ?>
                    <p><em>Nenhum arquivo disponível.</em></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum item cadastrado no acervo ainda.</p>
    <?php endif; ?>
</div>

<?php include '../../includes/footer.php'; ?>
