<?php
	$className = ($startBankroll<0?'negative':'positive');
?>
<h1 class="startBankroll">
	Bankroll inicial: <span class="<?php echo $className ?>"><?php echo Util::formatFloat($startBankroll, true) ?></span>
	
	<?php if( $edit ): ?>
		<span class="a"><?php echo link_to('[editar]', 'myAccount/index') ?></span>
	<?php endif; ?>
</h1>
