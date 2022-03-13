function DoLogin() {
	const meuForm = document.querySelector("form");
	let formData = new FormData(meuForm);

	const options = {
		method: "POST",
		body: formData
	}

	fetch("verifica_login.php", options)
		.then(response => {
			if (!response.ok) {
				throw new Error(response.status);
			}

			return response.json();
		})
		.then(RequestResponse => {
			if (RequestResponse.success)
				window.location = RequestResponse.destination;
			else
				document.querySelector("#loginFailed").style.display = 'block';
		})

		.catch(error => {
			meuForm.reset();
			console.error('Falha inesperada: ' + error);
		});
}
