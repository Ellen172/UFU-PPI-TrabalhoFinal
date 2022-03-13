<?php

require_once "../conexaoMysql.php";
require_once "../verifica_login.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

try {
    $sql = <<<SQL
    SELECT * FROM paciente INNER JOIN pessoa
    WHERE paciente.id_paciente = pessoa.id_pessoa
    SQL;

    $stmt = $pdo->query($sql);
} 
catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página Listagem de Pacientes">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_restrito.css">
    <title>Lista de Pacientes</title>
</head>

<body>
    <!-- Cabeçalho principal, presente em todas as páginas-->
    <header>
        <img src="../imagens/logotype.png" width="200" height="200" alt="logotipo da Clínica Aquae Vitae">
        <h1>Clínica Aquae Vitae</h1>
    </header>

    <!--Menu de naveção, com links para todas as páginas-->
    <div class="dropdown">
        <button class="btn btnNav dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Cadastrar
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" id="currently-active-tab" href="FORM_funcionario.php">Novo Funcionario</a>
            <a class="dropdown-item" href="FORM_paciente.php">Novo Paciente</a>
        </div>

        <button class="btn btnNav dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Listar
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="LIST_funcionario.php">Listar Funcionarios</a>
            <a class="dropdown-item" id="currently-active-tab" href="LIST_paciente.php">Listar Pacientes</a>
            <a class="dropdown-item" href="LIST_endereco.php">Listar Endereços</a>
            <a class="dropdown-item" href="LIST_agendamento.php">Agendamentos e Consultas dos Clientes</a>
            <a class="dropdown-item" href="LIST_consultas.php">Meus Agendamentos e Consultas</a>
        </div>

        <a class="btn btnNav" href="logout.php">Logout</a>
    </div>

    <div class="container">
        <main>
            <h2>Listar Pacientes</h2>
            <table class="table table-striped">
                <thead>
                    <tr class="table-info">
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Telefone</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Altura</th>
                        <th scope="col">Tipo Sanguíneo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = $stmt->fetch()) {
                        $id_pessoa = htmlspecialchars($row['id_pessoa']);
                        $nome = htmlspecialchars($row['nome']);
                        $sexo = $row['sexo'];
                        if($rsexo=='m'){
                            $sexo='Masculino';
                        } else if($sexo=='f'){
                            $sexo='Feminino';
                        } else {
                            $sexo='Outro';
                        }
                        $email = htmlspecialchars($row['email']);
                        $telefone = htmlspecialchars($row['telefone']);
                        $cep = htmlspecialchars($row['cep']);
                        $logradouro = htmlspecialchars($row['logradouro']);
                        $cidade = htmlspecialchars($row['cidade']);
                        $estado = htmlspecialchars($row['estado']);
                        $numero = htmlspecialchars($row['numero']);
                        $peso = htmlspecialchars($row['peso']);
                        $altura = htmlspecialchars($row['altura']);
                        $tipoSanguineo = htmlspecialchars($row['tipoSanguineo']);
                        
                        echo <<<HTML
                        <tr class="table-light">
                            <td>
                                <a href="EXC_pessoa.php?id_pessoa=$id_pessoa">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg></a>
                            </td>
                            <td>$nome</td>
                            <td>$sexo</td>
                            <td>$email</td>
                            <td>$telefone</td>
                            <td>$cep <br> $logradouro, $numero <br> $cidade, $estado</td>
                            <td>$peso</td>
                            <td>$altura</td>
                            <td>$tipoSanguineo</td>
                        </tr>      
                        HTML;
                    }
                    ?>
                </tbody>
            </table>

        </main>
    </div>
    
    <!--Rodapé-->
    <footer>
        © Copyright 2021. Todos os direitos reservados.
    </footer>

    <script src="../js/bootstrap.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", iniciaPagina);

        function iniciaPagina() {
            /*Chama função para adicionar Bootstrap*/
            adicionaBootstrap();
        }
    </script>
</body>

</html>