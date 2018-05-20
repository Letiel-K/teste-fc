<?php
session_start();
require_once 'config.php';

$destino = explode("/", $destino);
$controller = empty($destino[0]) ? "Familias" : $destino[0];
$metodo = empty($destino[1]) ? "" : $destino[1];
$parametros = null;
for ($i=2; $i < count($destino); $i++) { 
	$parametros[] = $destino[$i];
}
require_once "controller/MVC.php";
$mvc = new MVC;
$mvc->carregar($controller, $metodo, $parametros);