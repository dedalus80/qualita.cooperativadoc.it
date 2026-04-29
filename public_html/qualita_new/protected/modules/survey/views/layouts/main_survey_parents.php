<!doctype html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap CSS -->
		<link href="https://qualita.cooperativadoc.it/qualita_new/css/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<!-- Font Awesome (icone, es. calendario datepicker) -->
		<link href="https://qualita.cooperativadoc.it/qualita_new/bootstrap-assets/css/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

		<title><?php echo CHtml::encode($this->pageTitle);?></title>
	</head>

	<body class="bg-light">
		<div class="container">
			<main class="pb-5">
				<?php echo $content; ?>
			</main>

			<?php if (!empty($this->customFooter)): ?>
				<footer class="blog-footer">
					<?php echo $this->customFooter; ?>
				</footer>
			<?php else: ?>
			<footer class="blog-footer">
				<div class="row p-3">
					<div class="col-sm-3">
							<img src="<?php echo Yii::app()->request->baseUrl ."/images/survey/keluar_logo_21.png"; ?>" />
					</div>
					<div class="col-sm-3">
						<h3>Keluar s.r.l</h3>
						<p>
							Via Assietta 16/b  – 10128 Torino<br />
							t. +39.011.516.29.79<br />
							f. +39.011.517.54.86<br />
							e. info@keluar.it <br />
							pec. keluarsrl@pec.it<br />
						</p>
					</div>
					<div class="col-sm-2">
						<p>
							P.IVA e C.F. 07408880016<br />
							Codice SDI – BA6ET11<br />
							Sistema di Gestione Qualità Certificato ISO 9001 ente CSQA n°cert 14852
						</p>
					</div>
					<div class="col-sm-2">
						<p>
							<a href="https://keluar.it/condizioni-generali-di-vendita" target="_blank">Condizioni generali di vendita</a><br>
							<a href="https://keluar.it/privacy/" target="_blank">Privacy</a><br>
							<a href="https://keluar.it/cookie-policy/" target="_blank">Cookie Policy</a>
						</p>
					</div>
					<div class="col-sm-2">
							<a href="https://keluar.it/qualita-e-sicurezza/" target="_blank"><img style="max-width:200px"src="<?php echo Yii::app()->request->baseUrl ."/images/survey/bollo-qualita-keluar_02.png"; ?>" /></a>
					</div>
				</div>
			</footer>
			<?php endif; ?>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	</body>
</html>