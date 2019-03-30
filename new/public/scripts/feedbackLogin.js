$(document).ready(() => {
	setTimeout(fadeOutFeedback, 3000)
})

function fadeOutFeedback() {
	$('.div-feedback').fadeOut(2000, () => {
		$('.mensagem-feedback').remove()
	})
}