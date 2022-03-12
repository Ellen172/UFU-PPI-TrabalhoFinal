function buscaEndereco(cep) {
	if (cep.length != 9) return;

	let xhr = new XMLHttpRequest();
	xhr.open("GET", "../restrito/busca_endereco.php?cep=" + cep, true);

	xhr.onload = function () {
		
		// verifica o código de status retornado pelo servidor
		if (xhr.status != 200) {
		  console.error("Falha inesperada: " + xhr.responseText);
		  return;
		}
		
		// converte a string JSON para objeto JavaScript
		try {
		  var endereco = JSON.parse(xhr.responseText);
		}
		catch (e) {
		  console.error("String JSON inválida: " + xhr.responseText);
		  return;
		}
		
		// utiliza os dados retornados para preencher formulário
		let estado = document.getElementById("estado");
		let cidade = document.getElementById("cidade");
		let logradouro = document.getElementById("logradouro");

		estado.value = endereco.estado;
		cidade.value = endereco.cidade;
		logradouro.value = endereco.logradouro;
	}

	xhr.onerror = function () {
		console.error("Erro de rede - requisição não finalizada");
	};

	xhr.send();
}