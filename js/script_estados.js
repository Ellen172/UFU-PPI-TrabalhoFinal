let estados = [
    "AC", "AL", "AP", "AM",
    "BA",
    "CE",
    "DF",
    "ES",
    "GO",
    "MA", "MT", "MS", "MG",
    "PA", "PB", "PR", "PE", "PI",
    "RJ", "RN", "RS", "RO", "RR",
    "SC", "SP", "SE",
    "TO"
];

/*Chama a função adicionaEstados quando o usuário clica no campo Estados*/
window.onload = function () {
    const campoEstado = document.querySelector("#estado");
    campoEstado.addEventListener("click", adicionaEstados());
}

/*Função para adicionar estados*/
function adicionaEstados() {

    //Selecionamos o campo repertótio pelo id
    const campoEstado = document.querySelector("#estado");

    for (let i = 0; i < estados.length; i++) {
        //Criamos opções
        const novoOpt = document.createElement("option");

        //Acionamos o conteúdo do campo com o textcontet do array estados
        novoOpt.textContent = estados[i];

        //Opções é filho do campo estado
        campoEstado.appendChild(novoOpt);
    }
}