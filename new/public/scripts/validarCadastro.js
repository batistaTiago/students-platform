$.getScript('/scripts/genericValidator.js', () => {

    $(document).ready(() => {

        applyInitialStyle()

        let emailTextField = $('#studentEmailTextField')
        let senhaTextField = $('#studentPasswordTextField')
        let confirmacaoTextField = $('#studentPasswordConfirmationTextField')
        let nomeTextField = $('#studentNameTextField')
        let nascimentoDatePicker = $('#studentBirthdayDatePicker')
        let escolaridadeComboBox = $("#studentSchoolLevelComboBox")
        let experienteComboBox = $("#studentIsExperiencedComboBox")
        let areaPreferidaComboBox = $("#studentPreferredAreaComboBox")


        emailTextField.on('keyup blur', e => {
            let text = e.target.value
            if (text == '') {
                displayDefaultFeedback(emailTextField)
            } else if (isValidEmail(text)) {
                $.ajax({
                    type: 'POST',
                    url: '/get_user',
                    data: 'email=' + text,
                    dataType: 'json',
                    success: jsonServerData => {
                        console.log(jsonServerData)
                        if (jsonServerData.disponivel == 1) {
                            displayValidFeedback(emailTextField)
                        } else if (jsonServerData.disponivel == 0) {
                            displayInvalidFeedback(emailTextField)
                            /* TODO:  atualizar a interface com mensagem de que está em uso */
                            /*          (inserir html?) */
                        }
                    },
                    error: jsonServerData => {
                        console.log(jsonServerData)
                        displayInvalidFeedback(emailTextField)
                        /* não consigo conectar ao servidor */
                    }
                })
            } else {
                displayInvalidFeedback(emailTextField)
            }
        })


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

        nascimentoDatePicker.on('change blur keyup mouseup', e => {
            let date = new Date(nascimentoDatePicker.val())
            if (date == 'Invalid Date') {
                nascimentoDatePicker.removeClass('border-success')
                nascimentoDatePicker.addClass('border-danger')
            } else {
                nascimentoDatePicker.removeClass('border-danger')
                nascimentoDatePicker.addClass('border-success')
            }
        })


        escolaridadeComboBox.on('change', e => {
            if (escolaridadeComboBox.val() != 0) {
                displayDefaultFeedback(escolaridadeComboBox)
                escolaridadeComboBox.addClass('border-success')
            } else {
                escolaridadeComboBox.removeClass('border-success')
            }
        })

        experienteComboBox.on('change', e => {
            if (experienteComboBox.val() != 0) {
                displayDefaultFeedback(experienteComboBox)
                experienteComboBox.addClass('border-success')
            } else {
                experienteComboBox.removeClass('border-success')
            }
        })

        areaPreferidaComboBox.on('change', e => {
            if (areaPreferidaComboBox.val() != 0) {
                displayDefaultFeedback(areaPreferidaComboBox)
                areaPreferidaComboBox.addClass('border-success')
            } else {
                areaPreferidaComboBox.removeClass('border-success')
            }
        })


        $('form').on('submit', e => {
            e.preventDefault()

            let studentEmail = emailTextField.val()
            let studentPassword = senhaTextField.val()
            let studentPasswordConfirmation = confirmacaoTextField.val()
            let studentBirthday = new Date(nascimentoDatePicker.val())
            let studentSchoolLevel = escolaridadeComboBox.val()
            let studentIsExperienced = experienteComboBox.val()
            let studentPreferredArea = areaPreferidaComboBox.val()

            let erro = false

            if (!isValidEmail(studentEmail)) {
                displayInvalidFeedback(emailTextField, true)
                erro = true
            }

            else if (!isValidPassword(studentPassword)) {
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

            else if (studentBirthday == 'Invalid Date') {
                displayInvalidFeedback(nascimentoDatePicker, true)
                erro = true
            }

            else if (studentSchoolLevel == 0) {
                displayInvalidFeedback(escolaridadeComboBox, true)
                erro = true
            } 

            else if (studentIsExperienced == 0) {
                displayInvalidFeedback(experienteComboBox, true)
                erro = true
            } 

            else if (studentPreferredArea == 0) {
                displayInvalidFeedback(areaPreferidaComboBox, true)
                erro = true
            } 

            else if (!erro) {
                $('form')[0].submit();
            } else {
                $(button).addClass('')
            }
        })
    })

})