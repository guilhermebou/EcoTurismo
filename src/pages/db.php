<?php
$servername = "localhost";
$usuario = "postgres";
$senha = "Hlm5457767";
$nome_do_banco = "teste";

$dsn = "pgsql:host=$servername;dbname=$nome_do_banco";

try {
    $pdo = new PDO($dsn, $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexao falhou: " . $e->getMessage());
}
?>
