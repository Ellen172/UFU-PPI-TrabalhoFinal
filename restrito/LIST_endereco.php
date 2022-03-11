<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

try{
    $sql = <<<SQL
    SELECT id, cep, logradouro, cidade, estado
    FROM endereco
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
    <meta name="description" content="Página Listagem de Endereços">
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/style_restrito.css">
    <title>Lista de Endereços</title>
</head>

<body>
    <!-- Cabeçalho principal, presente em todas as páginas-->
    <header>
        <img src="../imagens/logotype.png" width="200" height="200" alt="logotipo da Clínica Aquae Vitae">
        <h1>Clínica Aquae Vitae</h1>
    </header>

    <!--Menu de naveção, com links para todas as páginas-->
    <div class="dropdown">
        <a class="btn" href="../index.html">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door"
                viewBox="0 0 16 16">
                <path
                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
            </svg>
        </a>
        <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Opções
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="cad_funcionario.html">Novo Funcionario</a>
            <a class="dropdown-item" href="cad_paciente.html">Novo Paciente</a>
            <a class="dropdown-item" href="lista_funcionario.html">Listar Funcionarios</a>
            <a class="dropdown-item" href="lista_paciente.html">Listar Pacientes</a>
            <a class="dropdown-item" id="currently-active-tab" href="lista_endereco.html">Listar Endereços</a>
            <a class="dropdown-item" href="lista_agendamento.html">Agendamentos e Consultas dos Clientes</a>
            <a class="dropdown-item" href="lista_consultas.html">Meus Agendamentos e Consultas</a>
            <a class="dropdown-item" href="../index.html">Sair</a>
        </div>
    </div>

    <div class="container">
        <main>
            <h2>Listar Endereços</h2>
            <table class="tabela">
                <tr class="tabela_head">
                    <th>#</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Logradouro</th>
                </tr>
                <?php
                while($row = $stmt->fetch()){

                    //Prevenção de ataques XSS
                    $id = $row["id"];
                    $cep = htmlspecialchars($row["cep"]);
                    $logradouro = htmlspecialchars($row["logradouro"]);
                    $cidade = htmlspecialchars($row["cidade"]);
                    $estado = htmlspecialchars($row["estado"]);

                    echo <<<HTML
                        <tr>
                            <td>
                                <a href="EXC_endereco.php?id=$id">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg></a>
                            </td>
                            <td>$cep</td>
                            <td>$logradouro</td>
                            <td>$bairro</td>
                            <td>$cidade</td>
                            <td>$estado</td>
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

</body>


</html>