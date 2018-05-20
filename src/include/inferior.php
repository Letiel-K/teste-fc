		<script type="text/javascript" src="<?php echo URL."js/jquery.min.js" ?>"></script>
		<script type="text/javascript" src="<?php echo URL."js/materialize.min.js" ?>"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$(".remover_familia").click(function(){
					if(confirm("Tem certeza?")){
						$.post("<?php echo URL.'Familias/remover' ?>", {
							id: $(this).val()
						}, function(result){
							if(result != ""){
								alert(result);
							}else{
								location.reload();
							}
						});
					}
				});

				$(".remover_guerra").click(function(){
					if(confirm("Tem certeza?")){
						$.post("<?php echo URL.'Guerras/remover' ?>", {
							id: $(this).val()
						}, function(result){
							if(result != ""){
								alert(result);
							}else{
								location.reload();
							}
						});
					}
				});
				$('select').formSelect();
				$('.data_inicio').datepicker({
					format: 'dd/mm/yyyy',
					i18n:{
						done: "Selecionar",
						cancel: "Cancelar",
						clear: "Limpar",
						weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
						weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
						weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
						monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
						months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					}
				});
				$('.data_fim').datepicker({
					format: 'dd/mm/yyyy',
					i18n:{
						done: "Selecionar",
						cancel: "Cancelar",
						clear: "Limpar",
						weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
						weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
						weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
						monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
						months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
					}
				});

				$(".select_familia").change(function(){
					atualizar_select($(this));
				});

				$(".form_pesquisa").submit(function(e){
					e.preventDefault();
					if($(".data_inicio").val() == null || $(".data_inicio").val() == "" || $(".data_fim").val() == null || $(".data_fim").val() == ""){
						alert("Informe os campos");
					}else{
						var data_inicio = $(".data_inicio").val().split("/");
						var data_fim = $(".data_fim").val().split("/");
						console.log(data_inicio);
						data_inicio = data_inicio[2]+"-"+data_inicio[1]+"-"+data_inicio[0];
						data_fim = data_fim[2]+"-"+data_fim[1]+"-"+data_fim[0];
						location.href = "<?php echo URL.'Guerras/index/'.(!empty($data['paginacao']['pagina_atual']) ? $data['paginacao']['pagina_atual'] : 1) ?>/"+data_inicio+"/"+data_fim;
					}
				});
			});
			<?php

				$id_familia_vencedora = $this->flashdata("id_familia_vencedora");
				if($id_familia_vencedora == ""){
					$id_familia_vencedora = "null";//para evitar que fique vazio
				}else{
					echo "atualizar_select();";
				}
			?>

			function atualizar_select(element = null){
				if($(".select_familia_desafiadora").val() != null && $(".select_familia_desafiada").val() != null){
					if($(".select_familia_desafiadora").val() != $(".select_familia_desafiada").val()){
						$(".select_familia_vencedora").find('option')
					    .remove()
					    .end()
					    .append('<option '+('<?php echo $id_familia_vencedora ?>' == $(".select_familia_desafiadora").val() ? "selected" : "")+' value="'+$(".select_familia_desafiadora").val()+'">'+$(".select_familia_desafiadora option:selected").text()+'</option>')
					    .append('<option '+('<?php echo $id_familia_vencedora ?>' == $(".select_familia_desafiada").val() ? "selected" : "")+' value="'+$(".select_familia_desafiada").val()+'">'+$(".select_familia_desafiada option:selected").text()+'</option>');
					}else{
						alert("Famílias Iguais");
						if(element != null)
							element.prop('selectedIndex', 0);
					}
				}
				$('select').formSelect();
			}
		</script>
	</body>
</html>