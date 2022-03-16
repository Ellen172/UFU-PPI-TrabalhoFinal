function enviaForm() {

	let xhr = new XMLHttpRequest();

	// O formulário será enviado como um objeto FormData
	// A requisição deve utilizar o método POST
	xhr.open("POST", "verifica_login.php");
	xhr.onload = function () {
		// verifica o código de status retornado pelo servidor
		if (xhr.status != 200) {
			console.error("Falha inesperada: " + xhr.responseText);
			return;
		}

		// converte a string JSON para objeto JS
		try {
			var response = JSON.parse(xhr.responseText);
		}
		catch (e) {
			console.error("String JSON inválida: " + xhr.responseText);
			return;
		}

		// utiliza os dados da resposta
		if (response.success)
			window.location = response.detail;
		else {
			document.querySelector("#loginFailed").style.display = 'block';
			form.senha.value = "";
			form.senha.focus();
		}
	}

	xhr.onerror = function () {
		console.error("Erro de rede - requisição não finalizada");
	};

	// envia o formulário de login utilizando a interface FormData
	const form = document.querySelector("form");
	xhr.send(new FormData(form));
}


