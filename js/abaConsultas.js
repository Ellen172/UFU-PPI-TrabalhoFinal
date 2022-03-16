/* Adiciona a página minhas consultas se o usuário logado for médico*/
function abaConsultas() {
	fetch("check_medico.php")
		.then(response => {
			if (!response.ok) {
				throw new Error(response.status);
			}

			return response.json();
		})
		.then(RequestResponse => {
			if (RequestResponse.success) {
				const a = document.createElement("a");
				a.setAttribute("class", "dropdown-item");
				a.setAttribute("href", "LIST_consultas.php");
				a.textContent = "Meus Agendamentos e Consultas";

				const campoMenu = document.querySelector("#listagem");

				campoMenu.appendChild(a);
			}

		})

		.catch(error => {
			console.error('Falha inesperada: ' + error);
		});

}

/* Adiciona a página minhas consultas se o usuário logado for médico*/
function opcaoConsultas() {
	fetch("check_medico.php")
		.then(response => {
			if (!response.ok) {
				throw new Error(response.status);
			}

			return response.json();
		})
		.then(RequestResponse => {
			if (RequestResponse.success) {
				const div = document.createElement("div");
				div.setAttribute("class", "row mb-2");

				const a = document.createElement("a");
				a.setAttribute("href", "LIST_consultas.php");
				a.textContent = "Meus Agendamentos e Consultas";

				const campoAgendamento = document.querySelector("#opcoes");

				div.appendChild(a)
				campoAgendamento.insertAdjacentElement('afterend', div);
			}

		})

		.catch(error => {
			console.error('Falha inesperada: ' + error);
		});

}
