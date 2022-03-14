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