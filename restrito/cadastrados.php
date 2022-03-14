<?php

require_once "../conexaoMysql.php";
require_once "../autentificacao.php";

session_start();
$pdo = mysqlConnect();
exitWhenNotLogged($pdo);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Página Notificação">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_restrito.css">
    <title>Notificação</title>
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
        <div class="dropdown-menu">
            <a class="dropdown-item" href="LIST_funcionario.php">Listar Funcionarios</a>
            <a class="dropdown-item" href="LIST_paciente.php">Listar Pacientes</a>
            <a class="dropdown-item" href="LIST_endereco.php">Listar Endereços</a>
            <a class="dropdown-item" href="LIST_agendamento.php">Agendamentos e Consultas dos Clientes</a>
            <a class="dropdown-item" href="LIST_consultas.php">Meus Agendamentos e Consultas</a>
        </div>

        <a class="btn btnNav" href="logout.php">Logout</a>
    </div>

    <div class="container">
        <main>
            <h2 class="notificacao">Dados Cadastrados com Sucesso!</h2>
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