	<ul class="photoList">
		<?php
			$criteria = new Criteria();
			$criteria->add( EventLivePhotoPeer::EVENT_LIVE_ID, $eventLiveId );
			$criteria->add( EventLivePhotoPeer::DELETED, false );
			$criteria->addDescendingOrderByColumn( EventLivePhotoPeer::CREATED_AT );
			$eventLivePhotoObjList = EventLivePhotoPeer::doSelect($criteria);
			
			foreach($eventLivePhotoObjList as $eventLivePhotoObj):
							
				$eventLivePhotoId = $eventLivePhotoObj->getId();
				$fileName         = Util::getFileName($eventLivePhotoObj->getFile()->getFilePath());
		?>
		<li id="eventLivePhoto-<?php echo $eventLivePhotoId ?>">
			<a href="<?php echo '/uploads/eventLivePhoto/eventLive-'.$eventLiveId.'/'.$fileName ?>" class="lightbox"><?php echo image_tag('/uploads/eventLivePhoto/eventLive-'.$eventLiveId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
			<?php echo link_to(image_tag('backend/icons/control/16/busy'), '#removeEventLivePhoto('.$eventLivePhotoId.')', array('class'=>'remove', 'title'=>'Remover esta imagem')) ?>
		</li>
		<?php endforeach; ?>
	</ul>