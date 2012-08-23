	<div id="eventResume">
		<div id="eventList">
			<h1>Resumo de eventos</h1>
			<div id="eventResumeList">
				<div id="eventResumeLoader">
					<div id="eventResumeLoaderArea"></div>
					<div id="eventResumeLoaderContent">
						<?php echo image_tag('home/eventResumeLoader.gif') ?><br/>
						<span>carregando lista de eventos...<span>
					</div>
				</div>
				<div id="eventListOffset0">
					<?php include_partial('home/resume/event/eventList', array('offset'=>0, 'eventDate'=>null)) ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="clear"></div>
	</div>