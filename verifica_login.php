<?php
    require "conexaoMysql.php";
    
    class RequestResponse
	{
		public $success;
		public $destination;

		function __construct($success, $destination)
		{
			$this->success = $success;
			$this->destination = $destination;
		}
	}

    $pdo = mysqlConnect();

    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";

    $sql = <<<SQL
        SELECT email, senhaHash FROM funcionario INNER JOIN pessoa
        WHERE funcionario.id funcionario = pessoa.id pessoa and email = ?
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
	
	$IsSucess = false;
	
	if(password_verify($senha, $row['senhaHash'])) $IsSucess = true;
    
    $RequestResponse = new RequestResponse($IsSucess, "restrito/cad_funcionario.html");

    echo json_encode($RequestResponse);
