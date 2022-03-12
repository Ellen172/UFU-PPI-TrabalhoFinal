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

    $sqlEmail = <<<SQL
        SELECT email
        FROM pessoa
        WHERE email = ?
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
    
    if($row != ""){
		$idPessoa = pdo->lastInsertId();
    
		$sqlSenha = <<<SQL
			SELECT senhaHash
			FROM funcionario
			WHERE id_funcionario = $idPessoa;
			SQL;
			
		$stmt = $pdo->query($sqlSenha);
		$row = $stmt->fetch();
		
		$IsSucess = false;
		
		if(password_verify($senha, $row['senhaHash'])) $IsSucess = true;
		
    }
    
    $RequestResponse = new RequestResponse($IsSucess, "restrito/cad_funcionario.html");

    echo json_encode($RequestResponse);


