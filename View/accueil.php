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
			<?php require_once './View/nav.php'; ?>
			<div class="row">
				<!-- begin aside -->
				<aside class="col-5">
					<div class="card mx-auto" style="width: 18rem;">
						<img src="./media/img/bg_5.jpg" class="card-img-top" alt="blogPicture">
						<div class="card-body">
							<h5 class="card-title">Nom du blog</h5>
							<p class="card-text text-muted">Nb Followers, Nb Posts</p>
							<a href="#"><img src="./media/img/user.png" alt="profilePicture"></a>
						</div>
					</div>
				</aside>
				<!-- end aside -->
				<!-- begin section -->
				<section class="col-7">
					<div class="jumbotron">
						<h1 class="display-4">Welcome</h1>
					</div>
					<div>
						<?= showPosts($posts) ?>
					</div>
				</section>
				<!-- end section -->
			</div>
		</main>
	</body>
</html>
