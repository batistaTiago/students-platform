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
    $('#studentAgeNumberField').attr('value', perfil.age)

    let options = $('select option')

    console.log($('body div.container'))
    
    for (let i = 0; i < options.length; i++) {
       let option = options[i]
       
       if ((option.value == perfil.schoolLevel) || (option.value == perfil.preferredArea)) {
        option.selected = true
       }
    }

    document.getElementById('exp-' + perfil.isExperienced).selected = true
}