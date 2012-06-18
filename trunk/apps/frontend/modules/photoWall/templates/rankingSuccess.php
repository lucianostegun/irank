<?php include_partial('home/component/commonBar', array('pathList'=>array(__('photoWall.title')=>'photoWall/index', 'Ranking'=>null))); ?>
<div class="moduleIntro">
	<?php echo image_tag('photos', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Confira as fotos mais votadas dos usuários.<br/>
	Não deixe de publicar a foto de seu evento, ela poderá aparecer em destaque no site e concorrer a prêmios!
</div>
<div class="clear"></div>
<table cellspacing="15" cellpadding="0" border="0" style="position: relative; top: 10px; left: 20px">
	<?php
		$criteria = new Criteria();
		$criteria->add( EventPhotoPeer::IS_SHARED, true );
		$criteria->add( EventPhotoPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::CONTEST_RATIO );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::CONTEST_WINS );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::CONTEST_RUNS );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::CREATED_AT );
		$criteria->setLimit( 20 );
		$eventPhotoObjList = EventPhotoPeer::doSelect($criteria);
		
		foreach($eventPhotoObjList as $photoContestPosition=>$eventPhotoObj):
						
			$eventPhotoId = $eventPhotoObj->getId();
			$eventId      = $eventPhotoObj->getEventId();
			$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());
			
			$createdAt     = $eventPhotoObj->getCreatedAt('d/m/Y');
			$username      = $eventPhotoObj->getPeople()->getUserSite()->getUsername();
			$eventName     = $eventPhotoObj->getEvent()->getEventName();
			$contestRation = $eventPhotoObj->getContestRatio();
			$photoCaption  = 'Foto enviada em <b>'.$createdAt.'</b> pelo usuário <b>'.$username.'</b><br/>registrada para o evento <b>'.$eventName.'</b>';
	?>
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td>
						<h1 class="photoContestPosition"><?php echo $photoContestPosition+1 ?>º</h1>
					</td>
					<td class="eventPhotoTable">
						<a href="<?php echo '/uploads/eventPhoto/event-'.$eventId.'/'.$fileName ?>" rel="lightbox" alt="<?php echo $photoCaption ?>"><?php echo image_tag('/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
					</td>
					<td class="eventPhotoInfo">
						<?php echo $photoCaption ?>
						<div class="photoRationInfo">Média de votos: <b><?php echo Util::formatFloat($contestRation, true) ?></b></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php endforeach; ?>
</table>