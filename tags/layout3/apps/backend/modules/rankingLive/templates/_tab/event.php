	<div id="quickAddEventsLinkDiv" style="position: absolute">
		<?php echo link_to(image_tag('backend/icons/light/add', array('class'=>'icon')).'<span>Adicionar etapas</span>', '#showAddEventForm(true)', array('class'=>'button greyishB', 'id'=>'showAddEventLink')) ?>
		<?php echo link_to('<span>Voltar</span>', '#showAddEventForm(false)', array('class'=>'button greyishB', 'style'=>'display: none', 'id'=>'hideAddEventLink')) ?>
	</div>
	<div class="mt40"></div>
<div class="widget" id="eventListDiv">
	
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTableCustom" id="eventLiveTable">
		<thead>
		    <tr>
				<th><div>Data/Hora<span></span></div></th>
				<th><div>Etapa<span></span></div></th>
				<th><div>Clube<span></span></div></th>
				<th><div>Buyin<span></span></div></th>
				<th><div>Blind<span></span></div></th>
				<th><div>Stack<span></span></div></th>
		    </tr>
		</thead>
		<tbody id="rankingLiveEventLiveList">
			<?php include_partial('rankingLive/include/event', array('rankingLiveObj'=>$rankingLiveObj)) ?>
		</tbody>
	</table>
</div>
<div id="quickAddEventFormDiv" class="form" style="display: none">
	<h3>Inclusão rápida de etapas</h3>
	<hr/><br/>
	<?php include_partial('rankingLive/include/quickEvent', array('rankingLiveObj'=>$rankingLiveObj)); ?>
</div>