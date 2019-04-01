function isValidEmail(email) {
    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    let result = re.test(String(email).toLowerCase())
    return result
}

function isValidPassword(password) {
    if (password == "") {
        return false
    } else if (password.indexOf(' ') != -1) {
        return false
    } else if (password.length < 6) {
        return false
    } else {
        return true
    }
}

function displayValidFeedback(element) {
    element.addClass('bt-valid-form-control')
    element.removeClass('bt-invalid-form-control')
    element.removeClass('bt-default-form-control')
}

function displayInvalidFeedback(element, shouldFocus = false) {
    element.addClass('bt-invalid-form-control')
    element.removeClass('bt-valid-form-control')
    element.removeClass('bt-default-form-control')
    if (shouldFocus) {
        element.focus()    
    }
}

function displayDefaultFeedback(element) {
    element.addClass('bt-default-form-control')
    element.removeClass('bt-invalid-form-control')
    element.removeClass('bt-valid-form-control')
}

function applyInitialStyle() {
    $('label').addClass('font-weight-bold bt-register-form-label-default-width input-group-text bt-default-form-control d-inline-block text-dark')
    $('input').addClass('form-control bt-default-form-control')
    $('select').addClass('form-control bt-default-form-control')
    $('.form-container').addClass('bt-centralized-element input-group bt-default-form-group mb-3')
}