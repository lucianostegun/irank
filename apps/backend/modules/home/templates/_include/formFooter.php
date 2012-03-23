<footer id="<?php echo $prefix ?>Footer">
	<div class="submit_link">
		<input type="submit" value="Salvar" class="save_btn">
		<input type="button" value="Cancelar" class="cancel_btn" onclick="goToPage('<?php echo $prefix ?>', 'index')">
	</div>
	<div class="formMessage" id="<?php echo $prefix ?>FormError">Erro ao salvar as informações do registro</div>
	<div class="formMessage" id="<?php echo $prefix ?>FormSuccess">Informações salvas com sucesso</div>
	<div class="formMessage indicator" id="<?php echo $prefix ?>Indicator">Processando, aguarde...</div>
</footer>