<div class="row">
	<div class="col s12 m10 offset-m1">
		<h2 class="blue-grey-text">Guerras</h2>
		<h4 class="green-text tex-darken-4"><?php echo $this->flashdata("sucesso") ?></h4>
		<h4 class="red-text text-darken-4"><?php echo $this->flashdata("erro") ?></h4>
		<div class="row">
			<form onsubmit="return false;" class='form_pesquisa' method="get">
				<div class="col s12">
					<h4 class="blue-grey-text text-darken-2">Pesquisar</h4>
				</div>
				<div class="col s12 m4 input-field">
					<?php
						$data_inicio = $this->flashdata("data_inicio_pesquisa");
						$data_fim = $this->flashdata("data_fim_pesquisa");
						if(!empty($data_inicio)){
							$data_inicio = date("d/m/Y", strtotime($data_inicio));
							$data_fim = date("d/m/Y", strtotime($data_fim));
						}
					?>
					<input value="<?php echo $data_inicio ?>" class="data_inicio" type="text" name="data_inicio" placeholder="__/__/____"/>
					<label>Data de Início</label>
				</div>
				<div class="col s12 m4 input-field">
					<input value="<?php echo $data_fim ?>" class="data_fim" type="text" name="data_fim" placeholder="__/__/____"/>
					<label>Data de Fim</label>
				</div>
				<div class="col s12 m4">
					<button class="btn blue" style="width: 100%; height: 100%;">Pesquisar</button>
				</div>
			</form>
		</div>
		<table class="striped responsive-table centered">
			<thead>
				<tr>
					<th>Família Desafiadora</th>
					<th>Família Desafiada</th>
					<th>Família Vencedora</th>
					<th>Data de Início</th>
					<th>Data de Fim</th>
					<th>Alterar</th>
					<th>Remover</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data["guerras"] as $guerra): ?>
					<tr>
						<td><b><?php echo $guerra->desafiadora ?></b></td>
						<td><b><?php echo $guerra->desafiada ?></b></td>
						<td><b><?php echo $guerra->vencedora ?></b></td>
						<td><b><?php echo date("d/m/Y", strtotime($guerra->data_inicio)) ?></b></td>
						<td><b><?php echo date("d/m/Y", strtotime($guerra->data_fim)) ?></b></td>
						<td><a href="<?php echo URL.'Guerras/alterar/'.$guerra->id ?>" class="btn waves-effect waves-light blue darken-4">Alterar</a></td>
						<td>
							<button value="<?php echo $guerra->id ?>" class="btn waves-effect waves-light red darken-4 remover_guerra">Remover</button>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
		<?php
			if(!count($data["guerras"])){
				echo "<h3 class='center blue-grey-text'>Nenhuma guerra encontrada</h3>";
			}
		?>
		<div class="row">
			<ul class="pagination center">
				<?php
				for ($i=$data["paginacao"]["primeira_pagina"]; $i <= $data["paginacao"]["ultima_pagina"] ; $i++) { 
					$atual = $i == $data["paginacao"]["pagina_atual"] ? "class='active'" : "";
					echo "<li $atual><a href='".URL."Guerras/index/$i"."'>$i</a></li>";
				}
				?>
			</ul>
		</div>
		<div class="center-align" style="padding-top: 2rem">
			<a href="<?php echo URL."Guerras/cadastrar" ?>" class="btn green darken-4 waves-effect waves-light">Adicionar Guerra</a>
		</div>
	</div>
</div>