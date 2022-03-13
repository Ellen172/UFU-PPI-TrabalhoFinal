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
        WHERE funcionario.id_funcionario = pessoa.id_pessoa and email = ?
        SQL;

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch();
	
	$IsSucess = false;
	
	if(password_verify($senha, $row['senhaHash'])) $IsSucess = true;

    $_SESSION['emailUsuario'] = $email;
    $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);  
    
    $RequestResponse = new RequestResponse($IsSucess, "restrito/FORM_funcionario.php");

    echo json_encode($RequestResponse);
?>