<!DOCTYPE html>
<html>
	<head>
		<title>Teste FC</title>
		<link rel="stylesheet" type="text/css" href="<?php echo URL."css/materialize.min.css" ?>">
		<style type="text/css">
			nav.nav-center ul {
			    text-align: center;
			}
			nav.nav-center ul li {
			    display: inline-block;
			    float: none;
			}
			nav.nav-center ul li a {
			    display: inline-block;
			}
		</style>
	</head>
	<body>
		<nav class="nav-center">
			<div class="nav-wrapper blue darken-4">
				<ul id="nav-mobile center">
					<li <?php echo $this->controller == 'Familias' ? 'class=\'active\'' : '' ?>><a href="<?php echo URL.'Familias' ?>">Famílias</a></li>
					<li <?php echo $this->controller == 'Guerras' ? 'class=\'active\'' : '' ?>><a href="<?php echo URL."Guerras" ?>">Guerras</a></li>
				</ul>
			</div>
		</nav>