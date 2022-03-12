<?php
	require '../conexaoMysql.php';
	$pdo = mysqlConnect();

	class endereco
	{
	  public $logradouro;
	  public $estado;
	  public $cidade;

	  function __construct($logradouro, $cidade, $estado)
	  {
		$this->logradouro = $logradouro;
		$this->cidade = $cidade;
		$this->estado = $estado; 
	  }
	}

	$sql = <<<SQL
		SELECT cep, logradouro, cidade, estado
		FROM endereco
	SQL;

	$stmt = $pdo->query($sql);

	while($row = $stmt->fetch()){
		$enderecos[$row['cep']] = new Endereco($row['logradouro'], $row['cidade'], $row['estado']);
	}

	$cep = $_GET['cep'] ?? '';

	$endereco = array_key_exists($cep, $enderecos) ? 
	  $enderecos[$cep] : new Endereco('', '', '');
	  
	echo json_encode($endereco);
