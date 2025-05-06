<?php include '../../includes/header.php'; ?>
<?php require 'db.php';?>



<div class="container">
    <h2>Rotas</h2>
    <p>Confira nossas trilhas e rotas ecológicas para explorar.</p>

    <div style="text-align: center;">
        <?php
        try {
            $stmt = $pdo->query("SELECT id FROM rota");

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id = htmlspecialchars($row['id']);
                echo <<<HTML
                <iframe frameBorder="0" scrolling="no" src="https://www.wikiloc.com/wikiloc/embedv2.do?id=$id&elevation=off&images=on&maptype=H" width="800" height="500"></iframe>
                <div style="color:#777;font-size:11px;line-height:16px;">
                    Powered by <a style="color:#4C8C2B;font-size:11px;line-height:16px;" target="_blank" href="https://www.wikiloc.com">Wikiloc</a>
                </div>
HTML;
            }
        } catch (PDOException $e) {
            echo "<p>Erro ao buscar rotas: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
