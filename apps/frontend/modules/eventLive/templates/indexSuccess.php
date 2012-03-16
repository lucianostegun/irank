<?php include_partial('home/component/commonBar', array('pathList'=>array('Eventos ao vivo'=>$moduleName.'/index'))); ?>
<div class="moduleIntro">
	Acompanhe e participe dos principais eventos presenciais do Brasil.<br/>
	Você pode utilizar a pesquisa no menu ao lado para filtrar os eventos por cidade, estado, buyin ou torneios.
</div>
<blockquote>
	<?php echo link_to('Detalhes de um evento', 'eventLive/details') ?>
</blockquote>