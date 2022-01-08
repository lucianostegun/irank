<?php
$eventPhotoContestObj = EventPhotoContest::getPhotoPair();

$eventPhotoIdLeft  = $eventPhotoContestObj->getEventPhotoIdLeft();
$eventPhotoIdRight = $eventPhotoContestObj->getEventPhotoIdRight();

$zoomLeft  = 'home/eventPhoto?id='.$eventPhotoIdLeft.'&zoom=1';
$zoomRight = 'home/eventPhoto?id='.$eventPhotoIdRight.'&zoom=1';
?>

<div id="photoVote">
	<h1>Concurso de fotos</h1>
	<div class="intro">Escolha a melhor entre duas fotos postadas pelos jogadores</div>
	<div class="photoOption" onmouseover="showOptionBar('left')" onmouseout="hideOptionBar('left')">
		<div class="photo" id="eventPhotoContestPhotoLeft" onclick="selectPhotoContest('left')" title="Clique para votar nesta foto" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdLeft ?>') center center no-repeat"></div>
		<div class="optionBar" id="optionBarLeft">
			<div class="option zoom" title="aumentar foto" onmouseover="changeClassName(this, 'option zoom hover')" onclick="" onmouseout="changeClassName(this, 'option zoom')">
				<?php echo link_to(image_tag('blank.gif', array('width'=>32)), $zoomLeft, array('id'=>'eventPhotoContestLinkLeft', 'rel'=>'lightbox')) ?>
			</div>
			<div class="option reported" id="photoContestReportLeft">Foto denunciada!</div>
			<div class="option report" title="denunciar foto" onclick="selectPhotoContest('left', true)" onmouseover="changeClassName(this, 'option report hover')" onmouseout="changeClassName(this, 'option report')"></div>
		</div>
	</div>
	
	
	<div class="photoOption" onmouseover="showOptionBar('right')" onmouseout="hideOptionBar('right')">
		<div class="photo" id="eventPhotoContestPhotoRight" onclick="selectPhotoContest('right')" title="Clique para votar nesta foto" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdRight ?>') center center no-repeat"></div>
		<div class="optionBar" id="optionBarRight">
			<div class="option zoom" title="aumentar foto" onmouseover="changeClassName(this, 'option zoom hover')" onclick="" onmouseout="changeClassName(this, 'option zoom')">
				<?php echo link_to(image_tag('blank.gif', array('width'=>32)), $zoomRight, array('id'=>'eventPhotoContestLinkRight', 'rel'=>'lightbox')) ?>
			</div>
			<div class="option reported" id="photoContestReportRight">Foto denunciada!</div>
			<div class="option report" title="denunciar foto" onclick="selectPhotoContest('right')" onmouseover="changeClassName(this, 'option report hover')" onmouseout="changeClassName(this, 'option report')"></div>
		</div>
	</div>
	
	
	
	<div class="clear"></div>
	<div class="links">
		<?php echo link_to('ver todas as fotos', 'photoWall/index') ?> | <?php echo link_to('classificação atual', 'photoWall/ranking') ?>
	</div>
</div>