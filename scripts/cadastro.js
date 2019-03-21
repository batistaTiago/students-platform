let userEmail = "python.email.smtp.modules@gmail.com"
let userPassword = "testingPythonModules!"

function submitClick() {
    let studentName = document.getElementById("studentNameTextField").value
    let studentAge = document.getElementById("studentAgeNumberField").value
    let studentSchoolLevel = document.getElementById("studentSchoolLevelComboBox").selectedOptions[0].text
    let studentIsExperienced = document.getElementById("studentIsExperiencedComboBox").selectedOptions[0].text
    let studentPreferredArea = document.getElementById("studentPreferredAreaComboBox").selectedOptions[0].text

    if (studentName == "") {
        alert("Escreva seu nome!")
    } else if (studentAge == "") {
        alert("Insira sua idade!")
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
        enviarCadastro(dados)
    }

}

function enviarCadastro(dados) {
    Email.send({
    Host : "smtp.gmail.com",
    Username : userEmail,
    Password : userPassword,
    To : 'netobalby@gmail.com',
    From : "cadastro@sistemalegal.com",
    Subject : "Cadastro de novo aluno",
    Body : dados
    }).then(message => {
        alert(message)
        if (message == "OK") {
            document.location.reload()
        }
    });
}