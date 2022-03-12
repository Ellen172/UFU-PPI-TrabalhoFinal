<?php
    require "../conexaoMysql.php";
    $pdo = mysqlConnect();

    $nome = $_POST["nome"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $cep = $_POST["cep"] ?? "";
    $estado = $_POST["estado"] ?? "";
    $cidade = $_POST["cidade"] ?? "";
    $logradouro = $_POST["logradouro"] ?? "";
    $numero = $_POST["numero"] ?? "";
    $dataInicioContrato = $_POST["dataInicioContrato"] ?? "";
    $salario = $_POST["salario"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $profissao = $_POST["profissao"] ?? "";
    $CRM = $_POST["CRM"] ?? "";
    $especialidade = $_POST["especialidade"] ?? "";
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try{
        $pdo->beginTransaction();
        $sqlPessoa = <<<SQL
            INSERT INTO pessoa (nome, sexo, email, telefone, cep, logradouro, cidade, estado)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        SQL;

        $stmt = $pdo->prepare($sqlPessoa);
        if(!$stmt->execute([$nome, $sexo, $email, $telefone, $cep, $logradouro, $cidade, $estado]))
            throw new Exception('Falha ao inserir na tabela pessoa');

        $idPessoa = $pdo->lastInsertId();

        $sqlFuncionario = <<<SQL
            INSERT INTO funcionario (id_funcionario, data_contrato, salario, senhaHash)
            VALUES (?, ?, ?, ?)
        SQL;

        $stmt = $pdo->prepare($sqlFuncionario);
        if(!$stmt->execute([$idPessoa, $dataInicioContrato, $salario, $senhaHash]))
            throw new Exception('Falha ao inserir na tabela funcionario');

        if($profissao == "medico"){
            $sqlMedico = <<<SQL
                INSERT INTO medico (id_medico, especialidade, crm)
                VALUES (?, ?, ?)
            SQL;

            $stmt = $pdo->prepare($sqlMedico);
            if(!$stmt->execute([$idPessoa, $especialidade, $CRM]))
                throw new Exception('Falha ao inserir na tabela medico');
        }

        $pdo->commit();
        header("location: cad_funcionario.html");
        exit();
    }

    catch (Exception $e){
        $pdo->rollBack();
        exit('Falha na transação: ' . $e->getMessage());
    }