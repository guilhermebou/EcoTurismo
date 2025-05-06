<?php include '../../includes/header.php'; ?>

<?php

$output = shell_exec("python3 map.py 2>&1");


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mapa Matinha</title>
    <style>
        iframe {
            width: 100%;
            height: 650px;
            border: none;
        }
    </style>
</head>
<body>
    <h1>Mapa | Parque da Matinha - Monte Carmelo-MG </h1>
    <iframe src="meu_mapa.html?versao=<?php echo time(); ?>"></iframe>
</body>
</html>
<?php include '../../includes/footer.php'; ?>
