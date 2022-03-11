<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $logradouro = $cidade = $estado = "";

$cep = $_POST["CEP"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";

try{
    $sql = <<<SQL
    INSERT INTO endereco(cep, logradouro, cidade, estado)
    VALUES (?, ?, ?, ?)
    SQL;

    /*Como vamos cadastrar dados fornecidos pelo usuários
      usamos prepare statements*/
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $cep, $logradouro, $cidade, $estado
    ]);

    header("location: cad_endereco.html");
    exit(); 
}
catch(Exception $e){

    if($e->errorInfo[1] === 1062)
        exit("Dados duplicados: " . $e->getMessage());
    else
        exit("Falha ao cadastrar dados: " . $e->getMessage());

}

?>