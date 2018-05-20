<?php
define("URL", "http://localhost/testefc/src/");
define("RAIZ", "/testefc/src/");
$destino = str_replace(RAIZ, "", $_SERVER["REQUEST_URI"]);
require_once "model/config-banco-dados.php";