<?php

require_once "../conexaoMysql.php";
require_once "../autentificacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

$email = $_SESSION["emailUsuario"];

try{
    
    $sql = <<<SQL
    SELECT 
        agenda.dia as dia, 
        agenda.horario as horario, 
        agenda.nome as paciente,
        pessoa.sexo as sexo, 
        pessoa.id_pessoa  
    FROM agenda 
    INNER JOIN pessoa
    ON agenda.id_medico = pessoa.id_pessoa 
    AND pessoa.email = "{$email}"
    SQL;

    $stmt = $pdo->query($sql);
}
catch(Exception $e){
    exit("Ocorreu uma falha: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página Listagem Minhas Consultas">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_restrito.css">
    <title>Lista Minhas Consultas</title>
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
            <a class="dropdown-item" href="FORM_funcionario.php">Novo Funcionario</a>
            <a class="dropdown-item" href="FORM_paciente.php">Novo Paciente</a>
        </div>

        <button class="btn btnNav dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Listar
        </button>
        <div class="dropdown-menu" id="listagem">
            <a class="dropdown-item" href="LIST_funcionario.php">Listar Funcionarios</a>
            <a class="dropdown-item" href="LIST_paciente.php">Listar Pacientes</a>
            <a class="dropdown-item" href="LIST_endereco.php">Listar Endereços</a>
            <a class="dropdown-item" href="LIST_agendamento.php">Agendamentos e Consultas dos Clientes</a>
        </div>

        <a class="btn btnNav" href="logout.php">Logout</a>
    </div>

    <div class="container">
        <main>
            <h2>Listar Agendamentos</h2>
            <table class="table table-striped">
                <thead>
                    <tr class="table-info">
                        <th>#</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Paciente</th>
                        <th>Sexo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while($row = $stmt->fetch()){
                        $id_agenda = $row["id_agenda"];
                        $dia = htmlspecialchars($row["dia"]);
                        $horario = htmlspecialchars($row["horario"]);
                        $paciente = htmlspecialchars($row["paciente"]);
                        $sexo = htmlspecialchars($row["sexo"]);
                        
                        echo <<<HTML
                            <tr class="table-light">
                                <td>
                                    <a href="EXC_agendamento.php?id_agenda=$id_agenda">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                    </svg></a>
                                </td>
                                <td>$dia</td>
                                <td>$horario</td>
                                <td>$paciente</td>
                                <td>$sexo</td>
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
    <script src="../js/abaConsultas.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", iniciaPagina);

        function iniciaPagina() {
            /*Chama função para adicionar Bootstrap*/
            adicionaBootstrap();

            /*Chama função adiciona aba Minhas Consultas*/
            abaConsultas();
        }
    </script>

</body>


</html>