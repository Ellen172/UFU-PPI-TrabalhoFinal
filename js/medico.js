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

window.addEventListener("DOMContentLoaded", iniciaPagina);

function iniciaPagina() {
    /*Chama função para adicionar Bootstrap*/
    adicionaBootstrap();

    /*Define quando a função adicionaEstados é executada*/
    const campoEstado = document.querySelector("#estado");
    campoEstado.addEventListener("click", adicionaEstados());
    
    /*Define quando a função de buscar endereço pelo cep é executada*/
    const inputCep = document.querySelector("#cep");
    inputCep.onkeyup = () => buscaEndereco(inputCep.value);

    /*Define quando as informações do médico serão preenchidas*/
    const radioMedico = document.getElementById("medico");
    const radioOutro = document.getElementById("outro");
    const fieldsetInfMedico = document.querySelector("#infMedico");

    radioMedico.onclick = () => {
        fieldsetInfMedico.style.display = 'block';
    } 
    radioOutro.onclick = () => {
        fieldsetInfMedico.style.display = 'none';
    }
}

/* Adiciona Bootstrap*/
function adicionaBootstrap() {
    //Criamos o elemento meta que guarda o código para responsividade
    const responsividade = document.createElement("meta");
    //Criamos a tag link para o documento CSS do Bootstrap
    const css = document.createElement("link");
    //Criamos a tag script para o JavaScript do Bootstrap
    const js = document.createElement("script");

    //Alteramos os atributos da tag meta responsividade
    responsividade.name = "viewport";
    responsividade.content = "width=device-width, initial-scale=1";

    //Alteramos os atributos da tag link css
    css.href = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    css.rel = "stylesheet";
    css.integrity = "sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC";
    css.crossOrigin = "anonymous";

    //Alteramos os atributos da tag script js
    js.src = "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js";
    js.integrity = "sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM";
    js.crossOrigin = "anonymous";

    //A inserção do Bootstrap é feita no head da página
    //Selecionamos o campo head
    const campoHead = document.querySelector("head");

    //Cada um dos campos criados é filho da tag head
    campoHead.appendChild(responsividade);
    campoHead.appendChild(css);
    campoHead.appendChild(js);
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

