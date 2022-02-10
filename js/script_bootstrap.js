/*Inserção de Bootstrap*/

//Quando a janela for carregada a função adicionaBootstrap é executada
window.addEventListener("DOMContentLoaded", adicionaBootstrap);

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