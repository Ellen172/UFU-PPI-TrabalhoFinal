<?php 

require "conexaoMysql.php";
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

try {
    // inserindo elementos na tabela pessoa
    $sql_pessoa = <<<SQL
    insert into pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
    values (?, ?, ?, ?, ?, ?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql_pessoa);
    $stmt->execute([
        $nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado
    ]);

    // recuperar id da tabela pessoa
    $idPessoa = $pdo->lastInsertId();

    // inserindo na tabela paciente
    $sql_paciente = <<<SQL
    insert into paciente(id_paciente, peso, altura, tipoSanguineo)
    values (?, ?, ?, ?)
    SQL;

    $stmt = $pdo->prepare($sql_paciente);
    $stmt->execute([
        $idPessoa, $peso, $altura, $tipoSaguineo
    ]);

    header("location: cad_paciente.html");
    exit(); 
}
catch(Exception $e){
    if($e->errorInfo[1] === 1062)
        exit("Dados duplicados: " . $e->getMessage());
    else
        exit("Falha ao cadastrar dados: " . $e->getMessage());

}

?>

<script>
    <alert>Dados inseridos com sucesso!</alert>
</script>