<header id="<?php echo $prefix ?>Header" class="formHeader">
	<div class="submit_link">
		<input type="submit" value="Salvar" class="save_btn">
		<input type="button" value="Cancelar" class="cancel_btn" onclick="goToPage('<?php echo $prefix ?>', 'index')">
	</div>
	<div class="formMessage error" id="<?php echo $prefix ?>HeaderError">Erro ao salvar as informações do registro</div>
	<div class="formMessage success" id="<?php echo $prefix ?>HeaderSuccess">Informações salvas com sucesso</div>
	<div class="formMessage indicator" id="<?php echo $prefix ?>HeaderIndicator">Processando, aguarde...</div>
</header>