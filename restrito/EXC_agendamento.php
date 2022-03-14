<?php
require "../conexaoMysql.php";
$pdo = mysqlConnect();

$id_agenda = $_GET["id_agenda"] ?? "";

try {

  $sql = <<<SQL
  DELETE FROM agenda
  WHERE id_agenda = ?
  LIMIT 1
  SQL;

  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois a declaração
  // SQL contem um parâmetro (cpf) vindo da URL
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_agenda]);

  header("location: excluidos.php");
  exit();
} 
catch (Exception $e) {  
  exit('Falha inesperada: ' . $e->getMessage());
}