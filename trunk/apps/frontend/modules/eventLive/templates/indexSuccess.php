<?php include_partial('home/component/commonBar', array('pathList'=>array('Eventos ao vivo'=>$moduleName.'/index'))); ?>
<div class="moduleIntro">
	Acompanhe e participe dos principais eventos presenciais do Brasil.<br/>
	Você pode utilizar a pesquisa no menu ao lado para filtrar os eventos por cidade, estado, buyin ou torneios.
</div>
<blockquote>
	<?php
		$eventLiveObjList = EventLivePeer::doSelect(new Criteria());
		
		foreach($eventLiveObjList as $eventLiveObj):
		
			echo link_to($eventLiveObj->getEventName(), 'eventLive/details?id='.$eventLiveObj->getId());
			echo '<br/>';
		
		endforeach;
	?>
</blockquote>