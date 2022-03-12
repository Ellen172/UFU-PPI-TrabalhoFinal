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
            <a class="dropdown-item" href="LIST_funcionario.php">Listar Funcionarios</a>
            <a class="dropdown-item" id="currently-active-tab" href="LIST_paciente.php">Listar Pacientes</a>
            <a class="dropdown-item" href="LIST_endereco.php">Listar Endereços</a>
            <a class="dropdown-item" href="LIST_agendamento.php">Agendamentos e Consultas dos Clientes</a>
            <a class="dropdown-item" href="lista_consultas.html">Meus Agendamentos e Consultas</a>
        </div>

        <a class="btn btnNav" href="../index.html">Logout</a>
    </div>

    <div class="container">
        <main>
            <h2>Listar Pacientes</h2>
            <table class="tabela">
                <tr class="tabela_head">
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Sexo</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Logradouro</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Altura</th>
                    <th scope="col">Tipo Sanguíneo</th>
                </tr>
                <?php
                    while ($row = $stmt->fetch()) {
                        $id_pessoa = $row['id_pessoa'];
                        $nome = $row['nome'];
                        if($row['sexo']=='m'){
                            $sexo='Masculino';
                        } else if($row['sexo']=='f'){
                            $sexo='Feminino';
                        } else {
                            $sexo='Outro';
                        }
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
                            <th>$id_pessoa</th> 
                            <th>$nome</th>
                            <th>$sexo</th>
                            <th>$email</th>
                            <th>$telefone</th>
                            <th>$cep</th>
                            <th>$logradouro</th>
                            <th>$cidade</th>
                            <th>$estado</th>
                            <th>$peso</th>
                            <th>$altura</th>
                            <th>$tipoSanguineo</th>
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