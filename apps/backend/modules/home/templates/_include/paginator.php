<?php
	$allowDelete = isset($allowDelete)?$allowDelete:true;
?>
<footer id="<?php echo $prefix ?>Footer">
	<div class="submit_link">
		<?php if( $allowDelete ): ?>
		<input type="button" value="Excluir" onclick="doDeleteRecords()">
		<?php endif; ?>
	</div>
	<div class="paginator" id="<?php echo $prefix ?>Paginator"><div id="<?php echo $prefix ?>PaginatorRecords"><?php echo $recordCount ?></div></div>
	<div class="formMessage indicator" id="<?php echo $prefix ?>Indicator">Processando, aguarde...</div>
</footer>