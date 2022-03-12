<?php
require "./conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $especialidade = $_GET["especialidade"] ?? "";

    $sql = <<<SQL
    SELECT nome FROM medico INNER JOIN pessoa
    WHERE medico.id_medico = pessoa.id_pessoa
    AND medico.especialidade = ?
    SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$especialidade]);
       
    $medicos = [];
    while ($row = $stmt->fetch()) {
        $medico = $row['nome'];
        array_push($medicos, $medico);
    }

    echo json_encode($medicos);
}
catch (Exception $e) {
    exit('Falha na transação: ' . $e->getMessage());
}