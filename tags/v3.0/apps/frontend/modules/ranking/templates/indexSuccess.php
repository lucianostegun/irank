<?php
	if( $userSiteObj->getRankingCount()==0 )
		$messageList = array('!Você ainda não está participando de nenhum ranking. <b>'.link_to('Clique aqui', 'ranking/new', array('class'=>'red')).'</b> para criar e compartilhar seu primeiro ranking.');
	else
		$messageList = array();
	
	include_partial('home/component/commonBar', array('pathList'=>array('Rankings'=>'ranking/index'), 'messageList'=>$messageList));
	
	$filter = $sf_params->get('filter');
?>
<?php echo image_tag('ranking', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Cada ranking representa uma temporada dos eventos que você joga com seus amigos.<br/>
	Nele você deve configurar o horário, buy-in, estilo e esquema de pontuação para classificar os jogadores.<br/></br>
	Na seção <b>Classificação</b> você pode acompanhar em que posição está atualmente e em todas as datas passadas.
</div>
<hr class="separator"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th width="200" class="first"><?php echo __('ranking.name') ?></th>
		<th><?php echo __('ranking.style') ?></th>
		<th><?php echo __('ranking.start') ?></th>
		<th><?php echo __('ranking.finish') ?></th>
		<th>Buy-in</th>
		<th><?php echo __('ranking.players') ?></th>
		<th><?php echo __('ranking.events') ?></th>
	</tr>
	<tbody id="rankingListContent">
	<?php include_partial('ranking/include/search', array('criteria'=>$criteria, 'userSiteObj'=>$userSiteObj)); ?>
	</tbody>
</table>
<?php if( !$filter ): ?>
<hr class="separator"/>
<div class="moduleFooter">
	Listando apenas os rankings ativos, com data de término maior ou igual a <b><?php echo date('d/m/Y') ?></b> ou sem data de término.<br/>
	Para listar os rankings mais antigos utilize o filtro à esquerda selecionando a opção <b>Todos os rankings</b>.
</div>
<?php endif; ?>