<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$id_funcionario = $_GET["id_funcionario"] ?? "";

try {

  $sql = <<<SQL
  DELETE FROM funcionario
  WHERE id = ?
  LIMIT 1
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois a declaração
  // SQL contem um parâmetro (cpf) vindo da URL
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_funcionario]);

  header("location: LIST_funcionario.php");
  exit();
} 
catch (Exception $e) {  
  exit('Falha inesperada: ' . $e->getMessage());
}