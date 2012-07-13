<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Minha conta'=>$moduleName.'/index', 'Convites'=>null)));
?>
<div class="moduleIntro">
	Confira abaixo todos os eventos para os quais você foi convidado via e-mail ou SMS. 
</div>

<div class="eventDetailsList">
	<div id="eventLiveTableContent" class="eventLiveTabContent active">
		<?php include_partial('myAccount/include/table', array()) ?>
	</div>
</div>
<br/><br/>
