<?php
require_once("./Connectar.php");

$conexao = new Connect_db();
$conexao->getConnection();

print_r( $conexao->prepare("Show databases"));

?>