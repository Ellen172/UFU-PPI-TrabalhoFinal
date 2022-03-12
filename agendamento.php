<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
    $sql = <<<SQL
    SELECT especialidade
    FROM medico
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
    <meta name="description" content="Agendamento de consulta">
    <link rel="stylesheet" href="./css/style.css">
    <title>Agendamento</title>
</head>

<body>
    <!-- Cabeçalho principal, presente em todas as páginas-->
    <header>
        <img src="imagens/logotype.png" width="200" height="200" alt="logotipo da Clínica Aquae Vitae">
        <h1>Clínica Aquae Vitae</h1>
    </header>

    <!--Menu de naveção, com links para todas as páginas-->
    <nav>
        <a href="./index.html">Home</a>
        <a href="./galeria.html">Galeria</a>
        <a id="currently-active-tab" href="./agendamento.php">Agendamento</a>
        <a href="./cad_endereco.html">Novo Endereço</a>
        <a href="./login.html">Login</a>
    </nav>

    <div class="container">
        <main>
            <form>
                <fieldset>
                    <legend>Dados da consulta</legend>
                    <div class="row m-3 g-3">
                        <div class="col-sm-4">
                            <label for="especialidade" class="form-label">Especialidade: </label>
                            <select id="especialidade" name="especialidade" class="form-select">
                                <option value="">Selecione..</option>
                                <?php
                                    while ($row = $stmt->fetch()) {
                                        $especialidade = $row['especialidade'];

                                        echo <<<HTML
                                        <option value="$especialidade">$especialidade</option>
                                        HTML;
                                    }

                                ?>
                            </select>
                        </div>
                        <div class="col-sm-8">
                            <label for="nome" class="form-label">Nome: </label>
                            <select id="nome" name="nome" class="form-select">
                                <option value="">Selecione..</option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3 g-3">
                        <div class="col-sm-4">
                            <label for="data" class="form-label">Data: </label>
                            <input type="date" id="data" name="data" class="form-control">
                        </div>
                        <div class="col-sm-8">
                            <label for="horario" class="form-label">Horário: </label>
                            <select id="horario" name="horario" class="form-select">
                                <option value="">Selecione..</option>
                            </select>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Dados do Paciente</legend>
                    <div class="row m-3 g-3">
                        <div class="col-sm-4">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" id="nome" name="nome" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="email" class="form-label">E-mail:</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label" for="sexo">Sexo: </label>
                            <select class="form-select" name="sexo" id="sexo" required>
                                <option value="">Selecione..</option>
                                <option value="f">Feminino</option>
                                <option value="m">Masculino</option>
                                <option value="o">Outros</option>
                            </select>
                        </div>
                    </div>
                </fieldset>

                <div class="d-grid gap-2 col-3 mx-auto my-4">
                    <button class="btn btn-light" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-send-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89.471-1.178-1.178.471L5.93 9.363l.338.215a.5.5 0 0 1 .154.154l.215.338 7.494-7.494Z" />
                        </svg>
                        Enviar
                    </button>
                </div>

            </form>
        </main>
    </div>

    <!--Rodapé-->
    <footer>
        © Copyright 2022. Todos os direitos reservados.
    </footer>

    <script src="./js/bootstrap.js"></script>
    <script>
        window.addEventListener("DOMContentLoaded", iniciaPagina);

        function iniciaPagina() {
            /*Chama função para adicionar Bootstrap*/
            adicionaBootstrap();
        }

    </script>


</body>

</html>