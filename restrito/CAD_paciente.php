<?php 

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$numero = $_POST["numero"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipoSanguineo = $_POST["tipoSanguineo"] ?? "";

try {
    $pdo->beginTransaction();

    // inserir pessoa
    $sql1 = <<<SQL
    INSERT INTO pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, numero, estado)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    SQL;
    $stmt = $pdo->prepare($sql1);
    if(! $stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $numero, $estado]))
        throw new Exception('Falha no cadastro de pessoa');

    $id_pessoa = $pdo->lastInsertId();
    
    // inserir paciente
    $sql2 = <<<SQL
    INSERT INTO paciente (id_paciente, peso, altura, tipoSanguineo)
    VALUES (?, ?, ?, ?) 
    SQL;
    $stmt = $pdo->prepare($sql2);
    if(! $stmt->execute([$id_pessoa, $peso, $altura, $tipoSanguineo]))
        throw new Exception('Falha no cadastro de paciente');

    $pdo->commit();
    header("location: cadastrados.html");
    exit();
}
catch (Exception $e) {
    $pdo->rollBack();
    exit('Falha na transação: ' . $e->getMessage());
}