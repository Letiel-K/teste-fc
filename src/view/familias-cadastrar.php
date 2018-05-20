<div class="row">
	<div class="col s12 m6 offset-m3">
		<div class="row">
			<h4 class="blue-grey-text center"><?php echo $data["titulo"] ?></h4>
		</div>
		<div class="row">
			<form action="" method="post">
				<div class="input-field">
					<input value="<?php echo $this->flashdata("nome_familia") ?>" type="text" name="nome" placeholder="Nome" />
					<label>Nome</label>
				</div>
				<div class="input-field">
					<input value="<?php echo $this->flashdata("quantidade_familia") ?>" type="number" name="quantidade_membros" placeholder="Quantidade de Membros" />
					<label>Quantidade de Membros</label>
				</div>
				<div class="input-field">
					<p class="red-text"><?php echo $this->flashdata("erro") ?></p>
				</div>
				<div class="input-field">
					<button class="btn blue darken-4 right" type="submit">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>