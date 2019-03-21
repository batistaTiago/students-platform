<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- Bootstrap -->
	<link rel="stylesheet"
	href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
	crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
	integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
	crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
crossorigin="anonymous">
</script>


</head>
<body>

	<div class="container">
		<?php include 'navigation-bar.php'; ?>

		<section>
			<div class="fundo-cinza container">
				<div class="row d-flex justify-content-center">
					<h1 class="text-info text-center elemento-bordado col-12 mt-2"> Página de login </h1>
					<div class="d-block">
						<form action="processa-login.php" method="post" class="mt-5 pt-5">

							<?php 

							if (isset($_GET['info'])) {
								$descricao = $_GET['info'];   
								if ($descricao == 'resultado-invalido') { 

									?>

									<div class="my-5 bg-danger">
										<h3 class="text-center my-5 py-2"><?= $descricao . '<ht>' ?></h3>
										</div>

										<?php 
									}
								} 
								?>

								<div class="centralized-element elemento-bordado w-100">
									<label>Email: </label>
									<input class="ml-1" type="text" name="userEmail">	
									<label class="ml-4">Senha: </label>
									<input class="ml-1" type="password" name="userPassword">	
								</div>
								<div class="d-flex justify-content-center my-3">
									<button class="btn btn-info" type="submit">Login</button>	
								</div>



							</form>
						</div>
					</div>
				</div>
			</section>

			<?php include 'footer.php'; ?>
		</div>



	</body>
	</html>