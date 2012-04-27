<?php include_partial('home/component/commonBar', array('pathList'=>array(__('photoWall.title')=>'photoWall/index', 'Ranking'=>null))); ?>
<div class="moduleIntro">
	<?php echo image_tag('photos', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	<?php echo __('photoWall.intro') ?>
</div>
<div class="clear"></div>
<table cellspacing="15" cellpadding="0" border="0" style="position: relative; top: 10px; left: 20px">
	<?php
		$criteria = new Criteria();
		$criteria->add( EventPhotoPeer::IS_SHARED, true );
		$criteria->add( EventPhotoPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::CONTEST_RATIO );
		$criteria->setLimit( 20 );
		$eventPhotoObjList = EventPhotoPeer::doSelect($criteria);
		
		$col        = 0;
		$commentRow = 0;
		foreach($eventPhotoObjList as $photoContestPosition=>$eventPhotoObj):
						
			$eventPhotoId = $eventPhotoObj->getId();
			$eventId      = $eventPhotoObj->getEventId();
			$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());
			
			if( $col > 0 && $col%6==0 )
				echo '</tr><tr id="commentRow'.($commentRow++).'" style="display: none"><td colspan="6">----</td></tr><tr>';
				
			$col++;
	?>
	<tr>
		<td>
			<table cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td>
						<h1 class="photoContestPosition"><?php echo $photoContestPosition+1 ?>º</h1>
					</td>
					<td class="eventPhotoTable">
						<a href="<?php echo '/uploads/eventPhoto/event-'.$eventId.'/'.$fileName ?>" rel="lightbox"><?php echo image_tag('/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php endforeach; ?>
</table>