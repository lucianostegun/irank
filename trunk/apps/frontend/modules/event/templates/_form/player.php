<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5px 5px 5px 15px">Lista dos convidados para este evento</td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm" id="eventPlayerDiv">
			<?php
				if( !$eventObj->isNew() )
					include_partial('event/include/player', array('eventObj'=>$eventObj)) ?>
		</td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm">
			<div class="row">
				<div class="halfLabel">Notificar</div>
				<div class="field"><?php echo select_tag('sendNotify', array('ask'=>'Perguntar', '1'=>'Sim', '0'=>'Não')) ?></div>
			</div>
		</td>
	</tr>
</table>