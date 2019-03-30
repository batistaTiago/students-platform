$(document).ready(() => {
	setTimeout(fadeMensagemDeErro, 3000)
	setTimeout(fadeMensagemDeUsuarioInativo, 3000)
})

function fadeMensagemDeErro() {
	$('#mensagem-erro').fadeOut(2000, () => {
		$('#mensagem-erro').remove()
	})
}

function fadeMensagemDeUsuarioInativo() {
	$('#mensagem-usuario-inativo').fadeOut(2000, () => {
		$('#mensagem-usuario-inativo').remove()
	})
}