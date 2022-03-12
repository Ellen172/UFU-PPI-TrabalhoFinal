<?php 

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["CEP"] ?? "";
$estado = $_POST["estado"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$numero = $_POST["numero"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tipoSaguineo = $_POST["tipoSaguineo"] ?? "";

// inserindo elementos na tabela pessoa
$sql_pessoa = <<<SQL
    insert into pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    values (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

// inserindo na tabela paciente
$sql_paciente = <<<SQL
    insert into paciente(id_paciente, peso, altura, tipoSanguineo)
    values (?, ?, ?, ?)
    SQL;

try {
    $pdo->beginTransaction();
    
    $stmt1 = $pdo->prepare($sql_pessoa);

    if(!$stmt1->execute([
        $nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado
    ])) throw new Exception('Falha na primeira inserção');

    // recuperar id da tabela pessoa
    $idPessoa = $pdo->lastInsertId();

    $stmt2 = $pdo->prepare($sql_paciente);

    if(!$stmt2->execute([
        $idPessoa, $peso, $altura, $tipoSaguineo
    ])) throw new Exception('Falha na segunda inserção');

    // Efetiva as operações
    $pdo->commit();

    header("location: cad_endereco.html");
    exit(); 
}
catch (Exception $e) {
    $pdo->rollBack();
    if ($e->errorInfo[1] === 1062)
      exit('Dados duplicados: ' . $e->getMessage());
    else
      exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}

?>