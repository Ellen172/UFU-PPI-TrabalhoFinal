<?php

    require '../conexaoMysql.php';
    session_start();
    $pdo = mysqlConnect();

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

    $IsSucess = false;

    // Verifica se as variáveis de sessão criadas
    // no momento do login estão definidas
    if (!isset($_SESSION['emailUsuario'], $_SESSION['loginString'])){
        $IsSucess = false;
    } 
    else{
        $email = $_SESSION['emailUsuario'];

        $sql = <<<SQL
        SELECT *
        FROM medico
        INNER JOIN pessoa
        WHERE medico.id_medico = pessoa.id_pessoa
        AND pessoa.email = "{$email}"
        LIMIT 1
        SQL;

        $stmt = $pdo->query($sql);
        $row = $stmt->fetch();
        if(strcmp($row['email'], $email) == 0) $IsSucess = true;
    }

    $RequestResponse = new RequestResponse($IsSucess, "LIST_consultas.php");
    echo json_encode($RequestResponse);


?>