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

    // Inserir Endereco
    $sqlEndereco = <<<SQL
        INSERT INTO endereco(cep, logradouro, cidade, estado)
        VALUES (?, ?, ?, ?)
    SQL;
    $stmt = $pdo->prepare($sqlEndereco);
    if(!$stmt->execute([$cep, $logradouro, $cidade, $estado]))
        throw new Exception('Falha ao inserir na tabela endereco');

    // Inserir Pessoa
    $sqlPessoa = <<<SQL
        INSERT INTO pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, numero, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    SQL;
    $stmt = $pdo->prepare($sqlPessoa);
    if(!$stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $numero, $estado]))
        throw new Exception('Falha ao inserir na tabela pessoa');

    $id_pessoa = $pdo->lastInsertId();
    
    // Inserir Paciente
    $sqlPaciente = <<<SQL
        INSERT INTO paciente (id_paciente, peso, altura, tipoSanguineo)
        VALUES (?, ?, ?, ?) 
    SQL;
    $stmt = $pdo->prepare($sqlPaciente);
    if(! $stmt->execute([$id_pessoa, $peso, $altura, $tipoSanguineo]))
        throw new Exception('Falha ao inserir na tabela paciente');

    $pdo->commit();
    header("location: cadastrados.php");
    exit();
}
catch (Exception $e) {
    $pdo->rollBack();
    exit('Falha na transação: ' . $e->getMessage());
}

?>