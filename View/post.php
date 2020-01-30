<?php

?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8"/>
        <title>Fakebook</title>
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet"/>
    </head>
    <body>
		<main class="container">
        <?php require_once './View/nav.php' ?>
			<div class="row">
				<!-- begin section -->
				<section class="col-7">
					<div class="jumbotron">
						<form>
                        <div class="mb-3">
                            <label for="validationTextarea">Commentaire</label>
                            <textarea class="form-control" id="validationTextarea" placeholder="Ajouter un commentaire" required></textarea>
                        </div>
                        </form>
					</div>
				</section>
				<!-- end section -->
			</div>
		</main>
	</body>
</html>