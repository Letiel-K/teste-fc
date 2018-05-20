<?php
	class GuerrasModel extends Model{
		function getGuerras($inicio = null, $offset = null, $data_inicio = null, $data_fim = null){
			if(!is_null($data_inicio) && !is_null($data_fim)){
				$data_inicio = date("Y-m-d", strtotime($data_inicio));
				$data_fim = date("Y-m-d", strtotime($data_fim));
				$where = " WHERE guerras.data_inicio >= '$data_inicio' AND guerras.data_fim <= '$data_fim'";
			}else{
				$where = "";
			}
			$query = "SELECT guerras.id, guerras.data_inicio, guerras.data_fim, desafiada.nome as desafiada, desafiadora.nome as desafiadora, vencedora.nome as vencedora FROM guerras LEFT JOIN familias as desafiadora ON (desafiadora.id = guerras.id_familia_desafiadora) LEFT JOIN familias as desafiada ON desafiada.id = guerras.id_familia_desafiada LEFT JOIN familias as vencedora ON vencedora.id = guerras.id_familia_vencedora $where";
			if(!is_null($inicio) && !is_null($offset)){
				$query .= " LIMIT $inicio, $offset";
			}
			$guerras = $this->con->query($query);
			$guerras = $guerras->fetchAll(PDO::FETCH_OBJ);
			return $guerras;
		}

		function getGuerra($id){
			$query = "SELECT id_familia_desafiadora, id_familia_vencedora, id_familia_desafiada, guerras.id, guerras.data_inicio, guerras.data_fim, desafiada.nome as desafiada, desafiadora.nome as desafiadora, vencedora.nome as vencedora FROM guerras LEFT JOIN familias as desafiadora ON (desafiadora.id = guerras.id_familia_desafiadora) LEFT JOIN familias as desafiada ON desafiada.id = guerras.id_familia_desafiada LEFT JOIN familias as vencedora ON vencedora.id = guerras.id_familia_vencedora WHERE guerras.id = $id";
			$guerras = $this->con->query($query);
			$guerras = $guerras->fetch(PDO::FETCH_OBJ);
			return $guerras;
		}

		function cadastrar($dados){

			$dados["data_inicio"] = date("Y-m-d", strtotime($dados["data_inicio"]));
			$dados["data_fim"] = date("Y-m-d", strtotime($dados["data_fim"]));

			$insert = $this->con->exec("INSERT INTO guerras (id_familia_desafiadora, id_familia_desafiada, id_familia_vencedora, data_inicio, data_fim) VALUES ($dados[id_familia_desafiadora], $dados[id_familia_desafiada], $dados[id_familia_vencedora], '$dados[data_inicio]', '$dados[data_fim]')");
			if($insert){
				$this->criar_flashdata("sucesso", "Guerra cadastrada com sucesso.");
				$this->redirect("Guerras");
			}else{
				$this->criar_flashdata("erro", "Ocorreu um erro ao cadastrar.");
			}
		}

		function alterar($dados){

			$dados["data_inicio"] = date("Y-m-d", strtotime($dados["data_inicio"]));
			$dados["data_fim"] = date("Y-m-d", strtotime($dados["data_fim"]));

			$update = $this->con->exec("UPDATE guerras SET id_familia_desafiadora=$dados[id_familia_desafiadora], id_familia_desafiada=$dados[id_familia_desafiada], id_familia_vencedora=$dados[id_familia_vencedora], data_inicio='$dados[data_inicio]', data_fim='$dados[data_fim]' WHERE guerras.id = $dados[id]");
			if($update){
				$this->criar_flashdata("sucesso", "Guerra alterada com sucesso.");
				$this->redirect("Guerras");
			}else{
				$this->criar_flashdata("erro", "Ocorreu um erro ao alterar.");
			}
		}

		function remover($id){
			$delete = $this->con->exec("DELETE FROM guerras WHERE guerras.id = $id");
			if($delete){
				$this->criar_flashdata("sucesso", "Guerra removida com sucesso.");
			}else{
				$this->criar_flashdata("erro", "Ocorreu um erro ao remover.");
			}
		}
	}