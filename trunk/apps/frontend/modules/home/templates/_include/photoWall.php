<div id="photoWall">
<!-- I18N -->
<h1>Últimas fotos...</h1>
	<?php
		$criteria = new Criteria();
		$criteria->add( EventPhotoPeer::IS_SHARED, true );
		$criteria->add( EventPhotoPeer::DELETED, false );
		$criteria->addDescendingOrderByColumn( EventPhotoPeer::CREATED_AT );
		$criteria->setLimit(12);
		$criteria->clearOrderByColumns();
		$criteria->addAscendingOrderByColumn('RANDOM()');
		$eventPhotoObjList = EventPhotoPeer::doSelect($criteria);
		
		foreach($eventPhotoObjList as $eventPhotoObj):
						
			$eventPhotoId = $eventPhotoObj->getId();
			$eventId      = $eventPhotoObj->getEventId();
			$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());
	?>
	<div class="image"><?php echo image_tag('/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName, array('width'=>100, 'onclick'=>'viewEventPhoto('.$eventPhotoId.')')); ?></div>
	<?php endforeach; ?>
</div>