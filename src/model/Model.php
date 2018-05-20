<?php
class Model{
	public $con;
	function __construct(){
		if(!isset($this->con) || empty($this->con)){
			require_once "conexao-banco.php";
			$this->con = conectar();
		}
	}

	public function redirect($url){
		header("Location: ".URL."$url");
		exit;
	}

	public function criar_flashdata($nome, $mensagem){
		$_SESSION[$nome] = $mensagem;
	}
}