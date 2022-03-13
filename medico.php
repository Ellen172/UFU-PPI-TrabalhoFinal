<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class Medico{
    public $id_medico;
    public $nome;
    public $especialidade;

    function __construct($id_medico, $nome, $especialidade)
    {
      $this->id_medico = $id_medico;
      $this->nome = $nome;
      $this->especialidade = $especialidade;
    }
}

try {
    $sql = <<<SQL
    SELECT id_medico, nome, especialidade
    from medico inner join pessoa
    on medico.id_medico = pessoa.id_pessoa
    SQL;

    $stmt = $pdo->query($sql);

    $medico = [];
    $cont = 0;
    while($row = $stmt->fetch()){
        $aux = new Medico($row["id_medico"], $row["nome"], $row["especialidade"]);
        $medico[$cont] = $aux;
        $cont++;
    }
    echo json_encode($medico);
} 
catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>