<?php
	class MVC{
		public $controller;
		public $metodo;
		public $parametros;
		public $data;

		public function redirect($url){
			header("Location: ".URL."$url");
			exit;
		}

		public function criar_flashdata($nome, $mensagem){
			$_SESSION[$nome] = $mensagem;
		}

		public function flashdata($nome){
			if(isset($_SESSION[$nome])){
				$mensagem = $_SESSION[$nome];
				unset($_SESSION[$nome]);
				return $mensagem;
			}else
				return "";
		}

		public function preencher($controller, $metodo, $parametros){
			$this->controller = $controller;
			$this->metodo = $metodo;
			$this->parametros = $parametros;
		}

		public function parametro($n){
			if(!empty($this->parametros[$n]))
				return $this->parametros[$n];
			else
				return null;
		}

		function view($view, $data = null){
			if(file_exists("view/".$view.".php")){
				require_once "include/superior.php";
				require_once "view/".$view.".php";
				require_once "include/inferior.php";
				if(!empty($data)){
					$this->data = $data;
				}
			}
			else
				echo "View não encontrada";
		}

		function model($model){
			require_once "model/Model.php";
			if(file_exists("model/".$model.".php")){
				require_once "model/".$model.".php";
				$model = new $model;
				return $model;
			}
			else
				echo "Model não encontrado";
		}

		public function carregar($controller, $metodo, $parametros){
			if(!empty($controller) && file_exists("controller/$controller.php")){
				require_once "controller/$controller.php";
				$classe = new $controller;
				$classe->preencher($controller, $metodo, $parametros);
				if(empty($metodo)){
					if(method_exists($classe, "index")){
						$classe->index();
					}else{
						echo "Página não encontrada";
					}
				}else{
					if(method_exists($classe, $metodo)){
						$classe->$metodo();
					}else{
						echo "Página não encontrada";
					}
				}
			}else{
				echo "Página não encontrada";
			}
		}
	}