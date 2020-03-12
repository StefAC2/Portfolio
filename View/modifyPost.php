<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Fakebook</title>
	<link href="../css/bootstrap.css" rel="stylesheet"/>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet"/>
</head>
<body>
	<main class="container">
		<?php require_once '../View/nav.php'; ?>
		<div class="row">
			<!-- begin section -->
			<section class="col-12">
				<form method="POST" action="" class="jumbotron col-7 mx-auto" enctype="multipart/form-data">
					<h2>Poster vos photos</h2>
					<label for="textarea">Commentaire</label>
					<textarea class="form-control" name="commentaire" id="textarea" placeholder="Ajouter un commentaire" required><?= $post['commentaire'] ?></textarea>
					<br/>
          <?php
          foreach ($post['medias'] as $media) {
            ?>
            <div class="jumbotron"><img src="<?= '../media/' . $media['nomMedia'] ?>" class="img img-fluid"/> <input type="checkbox"/></div>
            <?php
          }
          ?>
					<div class="input-group mb-3">
						<div class="custom-file">
							<input type="file" multiple accept="image/*,video/*,audio/*" name="medias[]" class="custom-file-input" id="images" required/>
							<label class="custom-file-label" for="images">Ajouter des medias</label>
						</div>
					</div>
					<input type="submit" value="Poster" class="btn btn-info"/>
				</form>
			</section>
			<!-- end section -->
		</div>
	</main>
</body>
</html>
