<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$especialidade = $medico = $data = $horario = "";
$paciente = $email = $sexo =  "";

$especialidade = $_POST["especialidade"] ?? "";
$medico = $_POST["medico"] ?? "";
$data = $_POST["data"] ?? "";
$horario = $_POST["horario"] ?? "";
$paciente = $_POST["paciente"] ?? "";
$email = $_POST["email"] ?? "";
$sexo = $_POST["sexo"] ?? "";

try{
    $sql = <<<SQL
    INSERT INTO agenda(dia, horario, nome, sexo, email, id_medico)
    VALUES (?, ?, ?, ?, ?, ?)
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