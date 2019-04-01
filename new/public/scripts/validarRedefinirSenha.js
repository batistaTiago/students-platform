$.getScript('/scripts/genericValidator.js', () => {


    $(document).ready(() => {

        console.log('estamos aqui')

        applyInitialStyle()

        let senhaTextField = $('#studentPasswordTextField')
        let confirmacaoTextField = $('#studentPasswordConfirmationTextField')


        senhaTextField.on('keyup blur', e => {
            let text = e.target.value
            if (text == '') {
                displayDefaultFeedback(senhaTextField)
            } else if (isValidPassword(senhaTextField.val())) {
                displayValidFeedback(senhaTextField)
                if (senhaTextField.val() == confirmacaoTextField.val()) {
                    displayValidFeedback(confirmacaoTextField)
                } else {
                    displayInvalidFeedback(confirmacaoTextField)
                }
            } else {
                displayInvalidFeedback(senhaTextField)
            }
        })

        confirmacaoTextField.on('keyup blur', e => {
            let text = e.target.value
            if (text == '') {
                displayDefaultFeedback(confirmacaoTextField)
            } else if (isValidPassword(senhaTextField.val()) && (senhaTextField.val() == confirmacaoTextField.val())) {
                displayValidFeedback(confirmacaoTextField)
            } else {
                displayInvalidFeedback(confirmacaoTextField)
            }
        })


        $('form').on('submit', e => {
            e.preventDefault()

            let studentPassword = senhaTextField.val()
            let studentPasswordConfirmation = confirmacaoTextField.val()

            let erro = false

            if (!isValidPassword(studentPassword)) {
                displayInvalidFeedback(senhaTextField, true)
                displayInvalidFeedback(confirmacaoTextField)
                erro = true
            }

            else if (studentPassword != studentPasswordConfirmation) {
                displayInvalidFeedback(senhaTextField)
                displayInvalidFeedback(confirmacaoTextField, true)
                erro = true
                console.log('senhas diferentes! erro!')
            }

            else if (!erro) {
                $('form')[0].submit();
            } else {
                $(button).addClass('')
            }
        })
    })


});