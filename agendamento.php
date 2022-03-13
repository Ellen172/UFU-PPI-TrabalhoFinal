<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Agenda{
    public $nome;
    public $dia;
    public $horario;

    function __construct($nome, $dia, $horario)
    {
      $this->nome = $nome;
      $this->dia = $dia;
      $this->horario = $horario;
    }
}

$medico = $_GET['id_medico'] ?? '';

try {
    $sql = <<<SQL
    SELECT dia, horario
    from agenda
    where id_medico = "{$medico}" 
    SQL;

    $stmt = $pdo->query($sql);

    $agenda = [];
    $cont = 0;
    while($row = $stmt->fetch()){
        $aux = new Agenda($row["nome"], $row["dia"], $row["horario"]);
        $agenda[$cont] = $aux;
        $cont++;
    }
    echo json_encode($agenda);
} 
catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>
