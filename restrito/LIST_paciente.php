<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect();

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
    <script src="../js/script.js"></script>
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
            <a class="dropdown-item" href="cad_funcionario.html">Novo Funcionario</a>
            <a class="dropdown-item" href="cad_paciente.html">Novo Paciente</a>
        </div>

        <button class="btn btnNav dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            Listar
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="lista_funcionario.html">Listar Funcionarios</a>
            <a class="dropdown-item" id="currently-active-tab" href="LIST_paciente.php">Listar Pacientes</a>
            <a class="dropdown-item" href="LIST_endereco.php">Listar Endereços</a>
            <a class="dropdown-item" href="lista_agendamento.html">Agendamentos e Consultas dos Clientes</a>
            <a class="dropdown-item" href="lista_consultas.html">Meus Agendamentos e Consultas</a>
        </div>

        <a class="btn btnNav" href="../index.html">Logout</a>
    </div>

    <div class="container">
        <main>
            <h2>Listar Pacientes</h2>
            <table class="tabela">
                <tr class="tabela_head">
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Tipo Sanguíneo</th>
                </tr>

                <?php
                    while ($row = $stmt->fetch()) {
                        $id_pessoa = $row['id_pessoa'];
                        $nome = $row['nome'];
                        $sexo = $row['sexo'];
                        $email = $row['email'];
                        $telefone = $row['telefone'];
                        $cep = $row['cep'];
                        $logradouro = $row['logradouro'];
                        $cidade = $row['cidade'];
                        $estado = $row['estado'];
                        $peso = $row['peso'];
                        $altura = $row['altura'];
                        $tipoSanguineo = $row['tipoSanguineo'];

                        echo <<<HTML
                        <tr>
                            <td>$id_pessoa</td> 
                            <td>$nome</td>
                            <td>$sexo</td>
                            <td>$email</td>
                            <td>$telefone</td>
                            <td>$cep</td>
                            <td>$logradouro</td>
                            <td>$cidade</td>
                            <td>$estado</td>
                            <td>$peso</td>
                            <td>$altura</td>
                            <td>$tipoSanguineo</td>
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