


// function displayInvalidityFeedback(container) {
//     let label = document.createElement('label')
//     label.className = 'text-danger my-0 ml-2 text-uppercase'
//     label.innerHTML = 'Campo inválido!'
//     container.appendChild(label)
// }

function passwordIsValid(password, confirmation) {
    console.log('validando senha: ' + password)
    if (password == "") {
        console.log('senha vazia')
        return false
    } else if (password != confirmation) {
        return false
    } else if (password.indexOf(' ') != -1) {
        console.log('senha tem espaço')
        return false
    } else if (password.length < 6) {
        return false
    } else {
        return true
    }
}


function submitClick() {

    console.log('validando dados')

    // TODO: recuperar com jquery - mt melhor - ver como fazer a importação
    let form = document.getElementById("form")
    let studentName = document.getElementById("studentNameTextField").value
    let studentPassword = document.getElementById("studentPasswordTextField").value
    let studentPasswordConfirmation = document.getElementById("studentPasswordConfirmationTextField").value
    let studentAge = document.getElementById("studentAgeNumberField").value
    let studentSchoolLevel = document.getElementById("studentSchoolLevelComboBox").selectedOptions[0].text
    let studentIsExperienced = document.getElementById("studentIsExperiencedComboBox").selectedOptions[0].text
    let studentPreferredArea = document.getElementById("studentPreferredAreaComboBox").selectedOptions[0].text

    // TODO: formatar mensagens de erro - mudar cores do campo que deu erro e ajeitar formatações em geral
    if (studentName == "") {
        alert('escreva seu nome')

    } else if (!passwordIsValid(studentPassword, studentPasswordConfirmation)) {
        alert('senha não obede critérios de segurança ou erro na confirmação da senha')

    } else if (studentAge == "") {

        alert('insira sua idade')

    } else if (studentSchoolLevel == "Selecione") {

        alert('selecione sua escolaridade')

    } else if (studentIsExperienced == "Selecione") {

        alert('selecione sua experiencia')

    } else if (studentPreferredArea == "Selecione") {

        alert('selecione sua area de preferencia')

    } else {
        form.submit();
    }
}