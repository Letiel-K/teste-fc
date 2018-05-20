<?php
	class FamiliasModel extends Model{
		function getFamilias($inicio = null, $offset = null){
			$query = "SELECT familias.id, familias.nome, familias.quantidade_membros,
				COUNT(guerras_vencidas.id) as total_guerras_vencidas, COUNT(guerras_perdidas.id) as total_guerras_perdidas, (COUNT(guerras_vencidas.id) + COUNT(guerras_perdidas.id)) as total_guerras
				FROM familias 

				LEFT JOIN guerras as guerras_vencidas ON guerras_vencidas.id_familia_vencedora = familias.id

				LEFT JOIN guerras as guerras_perdidas ON (guerras_perdidas.id_familia_vencedora <> familias.id AND (familias.id = guerras_perdidas.id_familia_desafiadora OR familias.id = guerras_perdidas.id_familia_desafiada))

				GROUP BY familias.id";
			if(!is_null($inicio) && !is_null($offset)){
				$query .= " LIMIT $inicio, $offset";
			}
			$familias = $this->con->query($query);
			$familias = $familias->fetchAll(PDO::FETCH_OBJ);
			return $familias;
		}

		function getFamilia($id){
			$query = "SELECT familias.id, familias.nome, familias.quantidade_membros, COUNT(guerras_desafiadora.id) AS total_desafiadora, COUNT(guerras_desafiada.id) as total_desafiada, (COUNT(guerras_desafiada.id) + COUNT(guerras_desafiadora.id)) as total_guerras, COUNT(guerras_perdidas.id) as total_guerras_perdidas, COUNT(guerras_vencidas.id) as total_guerras_vencidas FROM familias LEFT JOIN guerras as guerras_desafiadora ON (guerras_desafiadora.id_familia_desafiadora = familias.id) LEFT JOIN guerras as guerras_desafiada ON (guerras_desafiada.id_familia_desafiada = familias.id) LEFT JOIN guerras as guerras_vitorias ON (guerras_vitorias.id_familia_vencedora = familias.id) LEFT JOIN guerras as guerras_perdidas ON (guerras_perdidas.id_familia_vencedora <> familias.id AND (guerras_perdidas.id_familia_desafiada = familias.id OR guerras_perdidas.id_familia_desafiadora = familias.id)) LEFT JOIN guerras as guerras_vencidas ON (guerras_vencidas.id_familia_vencedora = familias.id) WHERE familias.id = $id GROUP BY familias.id";
			$familias = $this->con->query($query);
			$familias = $familias->fetch(PDO::FETCH_OBJ);
			return $familias;
		}

		function cadastrar($dados){
			$insert = $this->con->exec("INSERT INTO familias (nome, quantidade_membros) VALUES ('$dados[nome]', $dados[quantidade_membros])");
			if($insert){
				$this->criar_flashdata("sucesso", "Família cadastrada com sucesso.");
				$this->redirect("Familias");
			}else{
				$this->criar_flashdata("erro", "Ocorreu um erro ao cadastrar.");
			}
		}

		function alterar($dados){
			$update = $this->con->exec("UPDATE familias SET nome='$dados[nome]', quantidade_membros=$dados[quantidade_membros] WHERE familias.id = $dados[id]");
			if($update){
				$this->criar_flashdata("sucesso", "Família alterada com sucesso.");
				$this->redirect("Familias");
			}else{
				$this->criar_flashdata("erro", "Ocorreu um erro ao alterar.");
			}
		}

		function remover($id){
			$delete = $this->con->exec("DELETE FROM familias WHERE familias.id = $id");
			if($delete){
				$this->con->exec("DELETE FROM guerras WHERE guerras.id_familia_desafiada = $id OR guerras.id_familia_desafiadora = $id");
				$this->criar_flashdata("sucesso", "Família removida com sucesso.");//erro = vermelho
			}else{
				$this->criar_flashdata("erro", "Ocorreu um erro ao remover.");
			}
		}
	}