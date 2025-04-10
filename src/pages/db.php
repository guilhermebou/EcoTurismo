<?php
$servername = "localhost";
$usuario = "postgres";
$senha = "";
$nome_do_banco = "umpenoparque";

$dsn = "pgsql:host=$servername;dbname=$nome_do_banco";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexao falhou: " . $e->getMessage());
}
?>
