<div class="row">
	<div class="col s12 m6 offset-m3">
		<div class="row">
			<h4 class="blue-grey-text center"><?php echo $data["titulo"] ?></h4>
		</div>
		<div class="row">
			<form action="" method="post">
				<div class="row">
					<div class="input-field col s12">
						<select name="id_familia_desafiadora" class="select_familia select_familia_desafiadora">
							<option value="">Selecione</option>
							<?php
								$id_familia_desafiadora = $this->flashdata("id_familia_desafiadora");
							?>
							<?php foreach ($data["familias"] as $familia): ?>
								<option <?php echo $id_familia_desafiadora == $familia->id ? "selected" : "" ?> value="<?php echo $familia->id ?>"><?php echo $familia->nome ?></option>
							<?php endforeach ?>
						</select>
						<label>Família Desafiadora</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<select name="id_familia_desafiada" class="select_familia select_familia_desafiada">
							<option value="">Selecione</option>
							<?php
								$id_familia_desafiada = $this->flashdata("id_familia_desafiada");
							?>
							<?php foreach ($data["familias"] as $familia): ?>
								<option <?php echo $id_familia_desafiada == $familia->id ? "selected" : "" ?> value="<?php echo $familia->id ?>"><?php echo $familia->nome ?></option>
							<?php endforeach ?>
						</select>
						<label>Família Desafiada</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<select name="id_familia_vencedora" class="select_familia_vencedora">
							<option value="">Selecione</option>
						</select>
						<label>Família Vencedora</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
						<input value="<?php echo $this->flashdata('data_inicio') ?>" required type="text" class="datepicker data_inicio" name="data_inicio" placeholder="__/__/____">
						<label>Data de Início</label>
					</div>
					<div class="input-field col s6">
						<input value="<?php echo $this->flashdata('data_fim') ?>" required type="text" class="datepicker data_fim" name="data_fim" placeholder="__/__/____">
						<label>Data de Fim</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<p class="red-text"><?php echo $this->flashdata("erro") ?></p>
					</div>
				</div>
				<div class="row">
					<div class="input-field">
						<button class="btn blue darken-4 right" type="submit">Salvar</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>