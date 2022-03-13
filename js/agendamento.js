//VARIÁVEIS GLOBAIS
let medicos; // Os dados dos médicos(especialidade e nome)
let selecionado; // O médico selecionado

//REMOVE NÓS FILHOS
function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
    const selecione = document.createElement('option');
    selecione.text = "Selecione..";
    parent.appendChild(selecione);
}

//ADICIONA ESPECIALIDADE
function adicionaEspecialidade() {
    fetch("medico.php")
    .then(response => {
    if (!response.ok) {
        throw new Error(response.status);
    }

    return response.json();
    })
    .then(especialidades => {
        medicos = especialidades;

        let inputEspecialidade = document.querySelector("#especialidade");

        for(let dados of especialidades){
            var option = document.createElement("option");
            option.text = dados.especialidade;
            option.value = dados.especialidade;
            inputEspecialidade.appendChild(option);
        }
    })
    .catch(error => {

        inputEspecialidade.reset();
        console.error('Falha inesperada: ' + error);
    });
}

//ADICIONA MEDICO
function adicionaMedico(valor){
    let inputMedico = document.querySelector("#medico");
    removeAllChildNodes(inputMedico);

    for(let dados of medicos){
        if(dados.especialidade == valor){
            var option = document.createElement("option");
            option.text = dados.nome;
            option.value = dados.nome;
            inputMedico.appendChild(option);
        }
    }
}

//MEDICO SELECIONADO
function medicoSelecionado(valor){
    for(let medico of medicos){
        if(medico.nome == valor){
            selecionado = medico;
            return;
        }
    }
}

//ADICIONA HORA
function adicionaHora(e){
    let valor = e.target.value;

    fetch("agendamento.php?id_medico=" + selecionado.id_medico)
    .then(response => {
    if (!response.ok) {
        throw new Error(response.status);
    }
        return response.json();
    })
    .then(agenda => {

        let inputHorario = document.querySelector("#horario");
        
        let cont = [8,9,10,11,12,13,14,15,16,17];
        let aux = 0;
        
        for(let dados of agenda){
            if(dados.dia == valor){
                if(dados.horario == cont[aux]){
                    cont[aux] = 0;
                }
            }
            aux++;
        }
        for(let i = 0; i< 10; i++){
            if(cont[i] != 0){
                var option = document.createElement("option");
                option.text = cont[i];
                option.value = cont[i];
                inputHorario.appendChild(option);
            }
        }
    })
    .catch(error => {
        console.error('Falha inesperada: ' + error);
    });
}