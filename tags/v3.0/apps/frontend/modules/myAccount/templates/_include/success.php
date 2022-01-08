<div id="successDiv" style="display: <?php echo ($showSuccess?'block':'none') ?>">
	<center>
	<br/>
	<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex">
		<tr class="header">
			<th colspan="2">Cadastro concluído!</th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top">
				<b>Seja bem-vindo!</b><br/>
				Você já é um usuário <b>iRank</b>!<br/><br/>
				
				A partir de agora você já pode criar seus próprios rankings<br/>
				organizar eventos, obter relatórios e estatísticas dos jogos<br/>
				entre seus amigos.<br/><br/>
				
				Você está automaticamente identificado no site e já pode começar!<br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php echo link_to('clique aqui', 'ranking/create', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para criar seu primeiro ranking.<br/>
				<?php echo link_to('clique aqui', 'myAccount/index', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para editar as informações de seu cadastro.<br/><br/>
			</td>
		</tr>
	</table>
	</center>
</div>