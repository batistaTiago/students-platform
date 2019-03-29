$(document).ready(() => {

	setTimeout(fadeMensagemDeErro, 3000)

})

function fadeMensagemDeErro() {
	$('#mensagem-erro').fadeOut(2000, () => {
		$('#mensagem-erro').remove()
	})
}