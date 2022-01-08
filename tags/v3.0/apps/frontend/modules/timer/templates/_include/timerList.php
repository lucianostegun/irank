<table border="0" cellspacing="0" cellpadding="0" class="gridTable" id="timerListTable">
	<tr class="header">
		<th class="first" style="width: 300px">Nome</th>
		<th>Duração</th>
		<th>Níveis</th>
		<th>Total</th>
		<th>Ante</th>
		<th colspan="2">Som</th>
	</tr>
	<?php
		$timerObjList = TimerPeer::doSelect(new Criteria());
		
		foreach($timerObjList as $timerObj):
		
			$onclick = 'openTimer('.$timerObj->getId().')';
	?>
	<tr class="hoverable">
		<td class="textL" onclick="<?php echo $onclick ?>"><?php echo $timerObj->getTimerName() ?></td>
		<td class="textR" onclick="<?php echo $onclick ?>"><?php echo $timerObj->getDefaultDuration() ?> min</td>
		<td class="textR" onclick="<?php echo $onclick ?>"><?php echo $timerObj->getLevels() ?></td>
		<td class="textR" onclick="<?php echo $onclick ?>"><?php echo $timerObj->getTotalDuration() ?> min</td>
		<td class="textC" onclick="<?php echo $onclick ?>"><?php echo $timerObj->getHasAnte()?'Sim':'Não' ?></td>
		<td class="textC" onclick="<?php echo $onclick ?>"><?php echo $timerObj->getPlaySound()?'Sim':'Não' ?></td>
		<td class="textC"><?php echo link_to(image_tag('icon/delete'), '#removeTimer('.$timerObj->getId().')', array('title'=>'Remover esta configuração de blinds')) ?></td>
	</tr>
	<?php
		endforeach;
		if( empty($timerObjList) ):
	?>
	<tr>
		<td class="p10" colspan="7">
			Você ainda não configurou nenhum timer.<br/>
			Clique em <?php echo link_to('Nova configuração', '#startTimerWizard()') ?> para criar sua primeira configuração de blinds.
		</td>
	</tr>
	<?php endif; ?>
</table>