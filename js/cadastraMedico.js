
function cadastraMedico(){

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