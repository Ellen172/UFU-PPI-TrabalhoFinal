<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$id_pessoa = $_GET["id_pessoa"] ?? "";

try {

  $sql = <<<SQL
  DELETE FROM pessoa
  WHERE id_pessoa = ?
  LIMIT 1
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois a declaração
  // SQL contem um parâmetro (cpf) vindo da URL
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_pessoa]);

  header("location: excluidos.html");
  exit();
} 
catch (Exception $e) {  
  exit('Falha inesperada: ' . $e->getMessage());
}