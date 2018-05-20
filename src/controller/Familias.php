<?php
class Familias extends MVC{
	public function index(){
		$pagina_atual = (isset($this->parametros[0]) && is_numeric($this->parametros[0])) ? $this->parametros[0] : 1;
		$por_pagina = 10;
		$linha_inicial = ($pagina_atual - 1) * $por_pagina;
		$total_familias = count($this->model("FamiliasModel")->getFamilias());

		$primeira_pagina = 1;
		$ultima_pagina  = ceil($total_familias / $por_pagina);

		$familias = $this->model("FamiliasModel")->getFamilias($linha_inicial, $por_pagina);

		$paginacao = array(
			"primeira_pagina"=>$primeira_pagina,
			"ultima_pagina"=>$ultima_pagina,
			"pagina_atual"=>$pagina_atual
		);

		$this->view("familias", array("familias"=>$familias, "paginacao"=>$paginacao));
		session_destroy();//limpando as sessões de erro
	}

	public function cadastrar(){
		if(isset($_POST["nome"])){
			$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);//só retirando caracteres especiais... existem mais validações que devem ser feitas
			$quantidade_membros = filter_input(INPUT_POST, "quantidade_membros", FILTER_SANITIZE_SPECIAL_CHARS);

			if(!empty($nome) && is_numeric($quantidade_membros)){
				if(is_numeric($quantidade_membros)){
					$familias = $this->model("FamiliasModel");
					$familias->cadastrar(array("nome"=>$nome, "quantidade_membros"=>$quantidade_membros));
				}else{
					$this->criar_flashdata("nome_familia", $nome);
					$this->criar_flashdata("quantidade_familia", $quantidade_membros);
					$this->criar_flashdata("erro", "Quantidade deve ser um número.");
				}
			}else{
				$this->criar_flashdata("nome_familia", $nome);
				$this->criar_flashdata("quantidade_familia", $quantidade_membros);
				$this->criar_flashdata("erro", "Informe todos os campos.");
			}
		}
		$this->view("familias-cadastrar", array("titulo"=>"Cadastrar Família"));
	}

	function alterar(){
		$id = $this->parametros[0];
		$familias = $this->model("FamiliasModel");
		$familia = $familias->getFamilia($id);
		$this->criar_flashdata("nome_familia", $familia->nome);
		$this->criar_flashdata("quantidade_familia", $familia->quantidade_membros);

		if(isset($_POST["nome"])){
			$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);//só retirando caracteres especiais... existem mais validações que devem ser feitas
			$quantidade_membros = filter_input(INPUT_POST, "quantidade_membros", FILTER_SANITIZE_SPECIAL_CHARS);
			if(!empty($nome) && is_numeric($quantidade_membros)){
				if(is_numeric($quantidade_membros)){
					$familias = $this->model("FamiliasModel");
					$familias->alterar(array("id"=>$id, "nome"=>$nome, "quantidade_membros"=>$quantidade_membros));
				}else{
					$this->criar_flashdata("nome_familia", $nome);
					$this->criar_flashdata("quantidade_familia", $quantidade_membros);
					$this->criar_flashdata("erro", "Quantidade deve ser um número.");
				}
			}else{
				$this->criar_flashdata("nome_familia", $nome);
				$this->criar_flashdata("quantidade_familia", $quantidade_membros);
				$this->criar_flashdata("erro", "Informe todos os campos.");
			}
		}

		$this->view("familias-cadastrar", array("titulo"=>"Alterar Família"));
	}

	function remover(){
		$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
		if(is_numeric($id)){
			$familias = $this->model("FamiliasModel");
			$familias->remover($id);
		}else{
			echo "ID não informado";
		}
	}
}