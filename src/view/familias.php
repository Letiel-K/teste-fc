<div class="row">
	<div class="col s12 m10 offset-m1">
		<h2 class="blue-grey-text">Famílias</h2>
		<h4 class="green-text darken-4"><?php echo $this->flashdata("sucesso") ?></h4>
		<h4 class="red-text darken-4"><?php echo $this->flashdata("erro") ?></h4>
		<table class="striped responsive-table centered">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Total de Membros</th>
					<th>Total de Guerras Participadas</th>
					<th>Total de Vitórias</th>
					<th>Total de Derrotas</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data["familias"] as $familia): ?>
					<tr>
						<td><b><?php echo $familia->nome ?></b></td>
						<td><?php echo $familia->quantidade_membros ?></td>
						<td><?php echo $familia->total_guerras ?></td>
						<td><?php echo $familia->total_guerras_vencidas ?></td>
						<td><?php echo $familia->total_guerras_perdidas ?></td>
						<td><a href="<?php echo URL.'Familias/alterar/'.$familia->id ?>" class="btn waves-effect waves-light blue darken-4">Alterar</a></td>
						<td>
							<button value="<?php echo $familia->id ?>" class="btn waves-effect waves-light red darken-4 remover_familia">Remover</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<?php
			if(!count($data["familias"])){
				echo "<h3 class='center blue-grey-text'>Nenhuma família encontrada</h3>";
			}
		?>
		<div class="row">
			<ul class="pagination center">
				<?php
				for ($i=$data["paginacao"]["primeira_pagina"]; $i <= $data["paginacao"]["ultima_pagina"] ; $i++) { 
					$atual = $i == $data["paginacao"]["pagina_atual"] ? "class='active'" : "";
					echo "<li $atual><a href='".URL."Familias/index/$i"."'>$i</a></li>";
				}
				?>
			</ul>
		</div>
		<div class="center-align" style="padding-top: 2rem">
			<a href="<?php echo URL."Familias/cadastrar" ?>" class="btn green darken-4 waves-effect waves-light">Adicionar Família</a>
		</div>
	</div>
</div>