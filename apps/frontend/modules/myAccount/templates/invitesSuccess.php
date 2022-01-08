<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Minha conta'=>$moduleName.'/index', 'Convites'=>null)));
?>
<div class="moduleIntro">
	Abaixo estão listados todos os eventos para os quais você foi convidado via e-mail ou SMS. 
</div>
<hr class="separator"/>
<div class="eventDetailsList">
	<div id="eventTableContent" class="eventTabContent active">
		<?php include_partial('myAccount/include/event', array()) ?>
	</div>
	<hr class="mt15"/>
	<div class="clear mt5"></div>
	<div id="eventLiveTableContent" class="eventLiveTabContent active">
		<?php include_partial('myAccount/include/eventLive', array()) ?>
	</div>
</div>
<br/><br/>
