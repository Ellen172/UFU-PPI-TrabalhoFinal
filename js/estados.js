/*Função para adicionar estados*/
function adicionaEstados(campoEstado) {
    let estados = [
        "AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", 
        "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", 
        "RS", "RO", "RR", "SC", "SP", "SE", "TO"
    ];

    for (let i = 0; i < estados.length; i++) {
        //Criamos opções
        const novoOpt = document.createElement("option");

        //Acionamos o conteúdo do campo com o textcontet do array estados
        novoOpt.textContent = estados[i];

        //Opções é filho do campo estado
        campoEstado.appendChild(novoOpt);
    }
}