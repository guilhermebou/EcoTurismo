<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>PAGINA SEGURA!</h2>";
echo "logado com usuario:  " . $_SESSION['login'];
echo "<a href='logout.php'>Sair</a>";
?>
