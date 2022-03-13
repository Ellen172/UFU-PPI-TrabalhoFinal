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

$sql1 = <<<SQL
SELECT * from pessoa
where nome = "{$medico}"
limit 1
SQL;

$sql2 = <<<SQL
INSERT INTO agenda(dia, horario, nome, sexo, email, id_medico)
VALUES (?, ?, ?, ?, ?, ?)
SQL;



try{
    $pdo->beginTransaction();

    $stmt1 = $pdo->query($sql1);
    if(!$stmt1)
        throw new Exception('Falha na busca');

    $row = $stmt1->fetch();
    $medico = $row["id_pessoa"];

    $stmt2 = $pdo->prepare($sql2);
    if(! $stmt2->execute([$data, $horario, $paciente, $sexo, $email, $medico]))
        throw new Exception('Falha no agendamento');

    $pdo->commit();
    header("location: notificacao.html");
    exit();
}
catch(Exception $e){

    if($e->errorInfo[1] === 1062)
        exit("Dados duplicados: " . $e->getMessage());
    else
        exit("Falha ao cadastrar dados: " . $e->getMessage());

}

?>