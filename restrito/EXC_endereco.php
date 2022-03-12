<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$id_endereco = $_GET["id_endereco"] ?? "";

try {

  $sql = <<<SQL
  DELETE FROM endereco
  WHERE id = ?
  LIMIT 1
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois a declaração
  // SQL contem um parâmetro (cpf) vindo da URL
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_endereco]);

  header("location: LIST_endereco.php");
  exit();
} 
catch (Exception $e) {  
  exit('Falha inesperada: ' . $e->getMessage());
}