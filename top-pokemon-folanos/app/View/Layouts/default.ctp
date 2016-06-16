<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="Content-type" content="text/html; charset=utf-8" />
    <meta name="expires" content="0" />
    <meta name="pragma" content="no-cache" />
    <meta name="description" content="">
    <meta name="author" content="">
    <?= $this->Html->meta("icon"); ?>
    <title>Top 100 Pokémon de los Folanos</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap-theme.min.css" />
    
    <?php
		echo $this->Html->css(array('visibility', 'my-style', 'font-awesome.min'));
		echo $this->fetch('css');
	?>
	
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/u/bs-3.3.6/dt-1.10.12/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Stalinist+One">
	
	<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript"src="http://getbootstrap.com/assets/js/docs.min.js"></script>
    <script type="text/javascript"src="http://getbootstrap.com/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript"src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript"src="https://cdn.datatables.net/u/dt/dt-1.10.12/datatables.min.js"></script>
    <!--[if lt IE 9]>
      <script type="text/javascript"src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script type="text/javascript"src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body role="document">
	<footer>
		<div class="container">
			<div class="jumbotron" style="background-color: #c12e2a;">
				<div class="row">
					<div class="col-md-12 text-right">
						<div class="row">
							<div class="col-md-9">
								<h1 class="fuente" style="color: #ec971f;">TOP 100 POKÉMON DE LOS FOLANOS</h1>
							</div>
							<div class="col-md-3 text-center">
								<div class="alert" style="background-color: #ffffff !important;">
									<h1><?= $this->Html->image("Fola.jpg", array("width" => "80%")); ?></h1>
									<a style="color: #e62117;" target="_blank" href="https://www.youtube.com/user/Folagor03"><i class="fa fa-youtube-play fa-3x" aria-hidden="true"></i></a>
									<a style="color: #1da1f2;" target="_blank" href="https://twitter.com/FolagoR"><i class="fa fa-twitter fa-3x" aria-hidden="true"></i></a>
									<a style="color: #3f5d9a;" target="_blank" href="https://www.facebook.com/Folagor"><i class="fa fa-facebook-official fa-3x" aria-hidden="true"></i></a>
									<a style="color: #5a4080;" target="_blank" href="https://www.instagram.com/yoel__ramirez/"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<?= @$pagina; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
    <div class="container">
		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch("content"); ?>
    </div>
	<footer>
		<div class="container">
			<div class="jumbotron">
				<div class="row">
					<div class="col-md-12 text-right">
						<b>by Titiushko</b>: 
						<a target="_blank" href="https://github.com/titiushko"><i class="fa fa-github fa-3x" aria-hidden="true"></i></a>
						<a target="_blank" href="https://twitter.com/titiushko"><i class="fa fa-twitter fa-3x" aria-hidden="true"></i></a>
						<a target="_blank" href="https://www.instagram.com/titiushko/"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
						<a target="_blank" href="https://www.youtube.com/user/titiushkojazz"><i class="fa fa-youtube-play fa-3x" aria-hidden="true"></i></a>
						<a target="_blank" href="mailto:titiushko@gmail.com"><i class="fa fa-envelope fa-3x" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
		<?php
		//echo $this->element('sql_dump');
		?>
	</footer>
  </body>
</html>
