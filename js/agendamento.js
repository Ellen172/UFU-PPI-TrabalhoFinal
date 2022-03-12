function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
    const selecione = document.createElement('option');
    selecione.text = "Selecione..";
    parent.appendChild(selecione);
}

function selectMedico(especialidade){
    let selectMedico = document.getElementById('medico');
    fetch('selectMedico.php?especialidade='+especialidade)
        .then(response => {
            if(!response.ok)
                throw new Error('Not ok');
            return response.json();
        })
        .then(function (response) {
            removeAllChildNodes(selectMedico);
            response.forEach(medico => {
                const option = document.createElement('option');
                option.text = `${medico.nome} - ${medico.telefone}`;
                option.value = medico.nome;
                selectMedico.appendChild(option);
            })
        })
        .catch(error => console.log('Falha: '+error))
}