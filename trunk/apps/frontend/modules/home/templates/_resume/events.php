	<div id="eventResume">
		<?php include_partial('home/resume/calendar') ?>
		<div id="eventList">
			<div class="event next" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ JJ's Casino Club</div>
				<div class="when">14/02/2012 20:00</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="presence yes" onmouseover="this.className=this.className.replace('presence', 'presence hover')" onmouseout="this.className=this.className.replace(' hover', '')">
					<?php echo link_to('presença confirmada', '#return false', array('class'=>'confirmed')) ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="event next" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ Reyllagio</div>
				<div class="when">31/01/2012 20:00</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="presence" onmouseover="this.className=this.className.replace('presence', 'presence hover')" onmouseout="this.className=this.className.replace(' hover', '')">
					<?php echo link_to('confirmar presença', '#return false', array('class'=>'')) ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="event previous" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ AP 31 Cassinos Bar</div>
				<div class="when">24/01/2012 22:45</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="clear"></div>
			</div>
			<div class="event previous" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ JJ's Casino Club</div>
				<div class="when">17/01/2012 20:00</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="clear"></div>
			</div>
			<div class="loadEvents">
				<?php echo link_to('carregar mais eventos', '#return false') ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
