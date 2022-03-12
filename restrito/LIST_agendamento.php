<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = <<<SQL
    SELECT * FROM agenda INNER JOIN medico
    WHERE agenda.id_medico = medico.id_medico
    SQL;

    //Não será necessário usar prepare statements nesse caso
    //Já que nenhum parâmetro preenchido pelo usuário é usado na Query
    //Como há dados a serem processados usaremos o método query
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
    <meta name="description" content="Página Listagem de Agendamentos">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_restrito.css">
    <title>Lista de Agendamentos</title>
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
            <a class="dropdown-item" href="cad_funcionario.html">Novo Funcionario</a>
            <a class="dropdown-item" href="cad_paciente.html">Novo Paciente</a>
        </div>

        <button class="btn btnNav dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Listar
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="LIST_funcionario.php">Listar Funcionarios</a>
            <a class="dropdown-item" href="LIST_paciente.php">Listar Pacientes</a>
            <a class="dropdown-item" href="LIST_endereco.php">Listar Endereços</a>
            <a class="dropdown-item" id="currently-active-tab" href="LIST_agendamento.php">Agendamentos e Consultas dos Clientes</a>
            <a class="dropdown-item" href="lista_consultas.html">Meus Agendamentos e Consultas</a>
        </div>

        <a class="btn btnNav" href="../index.html">Logout</a>
    </div>

    <div class="container">
        <main>
            <h2>Listar Agendamentos</h2>
            <table class="tabela">
                <tr class="tabela_head">
                    <th>#</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Nome</th>
                    <th>Sexo</th>
                    <th>Email</th>
                    <th>Médico</th>
                </tr>
                <?php
                while($row = $stmt->fetch()){

                    //Prevenção de ataques XSS
                    $dia = htmlspecialchars($row["dia"]);
                    $horario = htmlspecialchars($row["horario"]);
                    $nome = htmlspecialchars($row["nome"]);
                    $sexo = htmlspecialchars($row["sexo"]);
                    $email = htmlspecialchars($row["email"]);
                    $medico = htmlspecialchars($row["especialidade"]);

                    echo <<<HTML
                        <tr>
                            <th>$dia</th>
                            <th>$horario</th>
                            <th>$nome</th>
                            <th>$sexo</th>
                            <th>$email</th>
                            <th>$medico</th>
                        </tr>
                    HTML;
                }
            ?>
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