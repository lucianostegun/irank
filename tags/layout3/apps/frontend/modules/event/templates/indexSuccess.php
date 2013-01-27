<?php
	$messageList = array();
	
	if( $userSiteObj->getEventCount()==0 )
		$messageList = array('!Você ainda não cadastrou nenhum evento. <b>'.link_to('Clique aqui', 'event/new', array('class'=>'red')).'</b> para criar seu primeiro evento.');
	
	include_partial('home/component/commonBar', array('pathList'=>array(__('event.title')=>'event/index'), 'messageList'=>$messageList));
	
	$filter = $sf_params->get('filter');
?>
<?php echo image_tag('event', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Os eventos representam os jogos realizados valendo para seus ranking.<br/>
	Os participantes receberão um convite para cada evento e os resultados irão compor a classificação do ranking.<br/><br/>
	Você pode definir a data, hora, local e valores para cada evento, além de postar comentários e fotos do jogo. 
</div>
<hr class="separator"/>
<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 225px" class="first"><?php echo __('Event') ?></th>
		<th style="width: 175px">Ranking</th>
		<th style="width: 110px"><?php echo __('DateTime') ?></th>
		<th style="width: 150px"><?php echo __('Place') ?></th>
		<th style="width: 50px" colspan="3"><?php echo __('Guests') ?></th>
	</tr>
	<tbody id="eventListContent">
	<?php include_partial('event/include/search', array('criteria'=>$criteria)); ?>
	</tbody>
</table>
<?php if( !$filter ): ?>
<hr class="separator"/>
<div class="moduleFooter">
	Listando apenas os eventos dos rankings ativos, com data de término maior ou igual a <b><?php echo date('d/m/Y') ?></b> ou sem data de término.<br/>
	Para listar os eventos de rankings mais antigos utilize o filtro à esquerda selecionando a opção <b>Todos os rankings</b>.
</div>
<?php endif; ?>