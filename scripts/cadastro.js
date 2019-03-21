let userEmail = "python.email.smtp.modules@gmail.com"
let userPassword = "testingPythonModules!"

function submitClick() {
    let studentName = document.getElementById("studentNameTextField").value
    let studentPassword = document.getElementById("studentPasswordTextField").value
    let studentAge = document.getElementById("studentAgeNumberField").value
    let studentSchoolLevel = document.getElementById("studentSchoolLevelComboBox").selectedOptions[0].text
    let studentIsExperienced = document.getElementById("studentIsExperiencedComboBox").selectedOptions[0].text
    let studentPreferredArea = document.getElementById("studentPreferredAreaComboBox").selectedOptions[0].text

    if (studentName == "") {

        let container = document.getElementById('studentNameContainer')
        displayInvalidityFeedback(container, "usuario")
        event.preventDefault()
        return false

    } else if (!verifyPasswordValidity(studentPassword)) {

        let container = document.getElementById('studentPasswordContainer')
        displayInvalidityFeedback(container, "senha")
        event.preventDefault()

    } else if (studentAge == "") {

        alert('insira sua idade')
        event.preventDefault()

    } else if (studentSchoolLevel == "Selecione") {

        alert('selecione sua escolaridade')
        event.preventDefault()

    } else if (studentIsExperienced == "Selecione") {

        alert('selecione sua experiencia')
        event.preventDefault()

    } else if (studentPreferredArea == "Selecione") {

        alert('selecione sua area de preferencia')
        event.preventDefault()

    } else {
        dados = {
            nome: studentName,
            idade: studentAge,
            escolaridade: studentSchoolLevel,
            fezEnem: studentIsExperienced,
            areaPretendida: studentPreferredArea
        }

        dados = JSON.stringify(dados)

        console.log(dados)

        // TODO: ENVIAR PARA O BACK-END OS DADOS VALIDADOS.
        post('processa-cadastro.php', dados)
    }

}


function verifyPasswordValidity(senha) {
    console.log('validando senha: ' + senha)
    if (senha == "") {
        console.log('senha vazia')
        return false
    } else if (senha.indexOf(' ') != -1) {
        console.log('senha tem espaço')
        return false
    } else {
        return true
    }
}

function displayInvalidityFeedback(container) {
    let label = document.createElement('label')
    label.className = 'text-danger my-0 ml-2 text-uppercase'
    label.innerHTML = 'Campo inválido!'
    container.appendChild(label)
}

function post(path, dataObject) {

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    let form = document.createElement("form")
    form.setAttribute("method", "post")
    form.setAttribute("action", path)

    for(let key in dataObject) {
        if(dataObject.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input")
            hiddenField.setAttribute("type", "hidden")
            hiddenField.setAttribute("name", key)
            hiddenField.setAttribute("value", dataObject[key])

            form.appendChild(hiddenField)
        }
    }

    document.body.appendChild(form)

    console.log(form)
    // form.submit();
}

// function enviarCadastro(dados) {
//     Email.send({
//     Host : "smtp.gmail.com",
//     Username : userEmail,
//     Password : userPassword,
//     To : 'netobalby@gmail.com',
//     From : "cadastro@sistemalegal.com",
//     Subject : "Cadastro de novo aluno",
//     Body : dados
//     }).then(message => {
//         alert(message)
//         if (message == "OK") {
//             document.location.reload()
//         }
//     });
// }