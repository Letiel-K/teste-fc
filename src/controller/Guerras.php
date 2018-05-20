<?php
	class Guerras extends MVC{
		function index(){

			@$data_inicio = $this->parametros[1];
			@$data_fim = $this->parametros[2];

			if(empty($data_inicio) && empty($data_fim)){
				$data_inicio = null;
				$data_fim = null;
			}else{
				$this->criar_flashdata("data_inicio_pesquisa", $data_inicio);
				$this->criar_flashdata("data_fim_pesquisa", $data_fim);
			}

			$pagina_atual = (isset($this->parametros[0]) && is_numeric($this->parametros[0])) ? $this->parametros[0] : 1;
			$por_pagina = 10;
			$linha_inicial = ($pagina_atual - 1) * $por_pagina;
			$total_guerras = count($this->model("GuerrasModel")->getGuerras(null, null, $data_inicio, $data_fim));

			$primeira_pagina = 1;
			$ultima_pagina  = ceil($total_guerras / $por_pagina);

			$paginacao = array(
				"primeira_pagina"=>$primeira_pagina,
				"ultima_pagina"=>$ultima_pagina,
				"pagina_atual"=>$pagina_atual
			);

			$guerras = $this->model("GuerrasModel")->getGuerras($linha_inicial, $por_pagina, $data_inicio, $data_fim);

			$this->view("guerras", array("guerras"=>$guerras, "paginacao"=>$paginacao));
			session_destroy();
		}

		function cadastrar(){
			$familias = $this->model("FamiliasModel");

			if(isset($_POST["id_familia_vencedora"])){
				$id_familia_desafiadora = filter_input(INPUT_POST, "id_familia_desafiadora", FILTER_SANITIZE_SPECIAL_CHARS);
				$id_familia_desafiada = filter_input(INPUT_POST, "id_familia_desafiada", FILTER_SANITIZE_SPECIAL_CHARS);
				$id_familia_vencedora = filter_input(INPUT_POST, "id_familia_vencedora", FILTER_SANITIZE_SPECIAL_CHARS);
				$data_inicio = filter_input(INPUT_POST, "data_inicio", FILTER_SANITIZE_SPECIAL_CHARS);
				$data_fim = filter_input(INPUT_POST, "data_fim", FILTER_SANITIZE_SPECIAL_CHARS);

				$this->criar_flashdata("id_familia_desafiadora", $id_familia_desafiadora);
				$this->criar_flashdata("id_familia_desafiada", $id_familia_desafiada);
				$this->criar_flashdata("id_familia_vencedora", $id_familia_vencedora);
				$this->criar_flashdata("data_inicio", $data_inicio);
				$this->criar_flashdata("data_fim", $data_fim);

				$data_inicio = explode("/", $data_inicio);
				$data_fim = explode("/", $data_fim);
				$data_inicio = $data_inicio[2]."-".$data_inicio[1]."-".$data_inicio[0];
				$data_fim = $data_fim[2]."-".$data_fim[1]."-".$data_fim[0];

				if(empty($id_familia_desafiadora) OR empty($id_familia_desafiada) OR empty($id_familia_vencedora) OR empty($data_inicio) OR empty($data_fim)){
					$this->criar_flashdata("erro", "Todos os campos são obrigatórios.");
				}else if(strtotime($data_inicio) > strtotime($data_fim)){
					$this->criar_flashdata("erro", "Datas inválidas.");
				}else if($id_familia_desafiadora == $id_familia_desafiada){
					$this->criar_flashdata("erro", "Famílias iguais!");
				}else if($id_familia_vencedora != $id_familia_desafiada && $id_familia_vencedora != $id_familia_desafiadora){
					$this->criar_flashdata("erro", "Família vencedora inválida!");
				}else{//passou
					$guerras = $this->model("GuerrasModel");
					$guerras->cadastrar(array("id_familia_desafiadora"=>$id_familia_desafiadora, "id_familia_desafiada"=>$id_familia_desafiada, "id_familia_vencedora"=>$id_familia_vencedora, "data_inicio"=>$data_inicio, "data_fim"=>$data_fim));
				}
			}

			$this->view("guerras-cadastrar", array("titulo"=>"Cadastrar Guerra", "familias"=>$familias->getFamilias()));
		}

		function alterar(){
			$id = $this->parametros[0];
			if(is_numeric($id) && !empty($id)){
				$guerra = $this->model("GuerrasModel");

				if(isset($_POST["id_familia_vencedora"])){
					$id_familia_desafiadora = filter_input(INPUT_POST, "id_familia_desafiadora", FILTER_SANITIZE_SPECIAL_CHARS);
					$id_familia_desafiada = filter_input(INPUT_POST, "id_familia_desafiada", FILTER_SANITIZE_SPECIAL_CHARS);
					$id_familia_vencedora = filter_input(INPUT_POST, "id_familia_vencedora", FILTER_SANITIZE_SPECIAL_CHARS);
					$data_inicio = filter_input(INPUT_POST, "data_inicio", FILTER_SANITIZE_SPECIAL_CHARS);
					$data_fim = filter_input(INPUT_POST, "data_fim", FILTER_SANITIZE_SPECIAL_CHARS);


					$data_inicio = explode("/", $data_inicio);
					$data_fim = explode("/", $data_fim);
					$data_inicio = $data_inicio[2]."-".$data_inicio[1]."-".$data_inicio[0];
					$data_fim = $data_fim[2]."-".$data_fim[1]."-".$data_fim[0];

					if(empty($id_familia_desafiadora) OR empty($id_familia_desafiada) OR empty($id_familia_vencedora) OR empty($data_inicio) OR empty($data_fim)){
						$this->criar_flashdata("erro", "Todos os campos são obrigatórios.");
					}else if(strtotime($data_inicio) > strtotime($data_fim)){
						$this->criar_flashdata("erro", "Datas inválidas.");
					}else if($id_familia_desafiadora == $id_familia_desafiada){
						$this->criar_flashdata("erro", "Famílias iguais!");
					}else if($id_familia_vencedora != $id_familia_desafiada && $id_familia_vencedora != $id_familia_desafiadora){
						$this->criar_flashdata("erro", "Família vencedora inválida!");
					}else{//passou
						$guerras = $this->model("GuerrasModel");
						$guerras->alterar(array("id"=>$id, "id_familia_desafiadora"=>$id_familia_desafiadora, "id_familia_desafiada"=>$id_familia_desafiada, "id_familia_vencedora"=>$id_familia_vencedora, "data_inicio"=>$data_inicio, "data_fim"=>$data_fim));
					}
				}

				$familias = $this->model("FamiliasModel")->getFamilias();
				$this->view("guerras-alterar", array("guerra"=>$guerra->getGuerra($id), "titulo"=>"Alterar Guerra", "familias"=>$familias));
			}else{
				$this->criar_flashdata("erro", "Guerra não encontrada");
				$this->redirect("Guerras");
			}
		}

		function remover(){
			$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
			if(is_numeric($id)){
				$guerras = $this->model("GuerrasModel");
				$guerras->remover($id);
			}else{
				echo "ID não informado";
			}
		}
	}