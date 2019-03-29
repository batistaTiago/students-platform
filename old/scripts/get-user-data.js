function requestUserData() {
    var request = new XMLHttpRequest()

    request.open('GET', 'get-user-data.php')

    request.onreadystatechange = () => {
        if (request.readyState == 4) {
            if (request.status == 200) {
                handleResponse(request.responseText)
                return
            }
        } else {
            return
        }

        alert('erro capturando dados do server')
    }
    request.send()
}



function handleResponse(serverResponse) {
    let perfil = JSON.parse(serverResponse)

    $('#studentEmailTextField').attr('value', perfil.email)
    $('#studentBirthdayDatePicker').attr('value', perfil.birthday)


    $('img').attr('class', 'img-fluid d-none d-md-block centralized-element')


    let options = $('select option')
    console.log(perfil.isExperienced)
    
    for (let i = 0; i < options.length; i++) {
        let option = options[i]
        if (!option) {
            continue
        } else if (option.value == "Selecione") {
            continue
        }

        if ((option.value == perfil.schoolLevel) || (option.value == perfil.preferredArea)) {
            option.selected = true
        }
    }

    $('#exp-' + perfil.isExperienced).attr('selected', true)
}