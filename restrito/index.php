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
	<meta name="description" content="Página Home - Restrita">
	<link rel="stylesheet" href="../css/style.css">
	<title>Home - Restrita</title>

	<style>
		div>main {
			text-align: center;
		}

		main>h2 {
			margin-bottom: 30px;
		}

		div>a {
			text-decoration: none;
			color: azure;
			border: 0.1px solid azure;
			padding: 10px;
		}

		.col>.row {
			width: 90%;
			margin-left: 5%;
		}

		.col>.row:hover {
			font-weight: bold;
			background-color: azure;
			color: rgba(8, 89, 129, 0.8);
			border-radius: 5px;
		}

		.container {
			margin: 70px 0px;
		}
	</style>
</head>

<body>
	<!-- Cabeçalho principal, presente em todas as páginas-->
	<header>
		<img src="../imagens/logotype.png" alt="logotipo da Clínica Aquae Vitae">
		<h1>Clínica Aquae Vitae</h1>
	</header>

	<div class="container">
		<main>
			<h2>O que deseja fazer agora?</h2>
			<div class="row">
				<div class="col">
					<div class="row mb-2">
						<a href="FORM_funcionario.php">Novo Funcionario</a>
					</div>
					<div class="row mb-2">
						<a href="FORM_paciente.php">Novo Paciente</a>
					</div>
					<div class="row mb-2">
						<a href="LIST_funcionario.php">Listar Funcionarios</a>
					</div>
					<div class="row mb-2">
						<a href="LIST_paciente.php">Listar Pacientes</a>
					</div>
					<div class="row mb-2">
						<a href="LIST_endereco.php">Listar Endereços</a>
					</div>
					<div class="row mb-2" id="opcoes">
						<a href="LIST_agendamento.php">Listar Agendamentos</a>
					</div>
					<div class="row mb-2">
						<a href="../index.html">Logout</a>
					</div>
				</div>
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
        opcaoConsultas();
		}
	</script>
</body>


</html>
