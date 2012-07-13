<div class="textC">
	<table cellspacing="15" cellpadding="0" border="0">
		<tr>
			<?php
				$eventLiveId = $eventLiveObj->getId();
				
				$criteria = new Criteria();
				$criteria->add( EventLivePhotoPeer::EVENT_LIVE_ID, $eventLiveId );
				$criteria->add( EventLivePhotoPeer::DELETED, false );
				$criteria->addDescendingOrderByColumn( EventLivePhotoPeer::CREATED_AT );
				$eventLivePhotoObjList = EventLivePhotoPeer::doSelect($criteria);
				
				$recordCount = 0;
				foreach($eventLivePhotoObjList as $eventLivePhotoObj):
								
					$eventLivePhotoId = $eventLivePhotoObj->getId();
					$fileName         = Util::getFileName($eventLivePhotoObj->getFile()->getFilePath());
					
					if( $recordCount > 0 && $recordCount%6==0 )
						echo '</tr><tr>';
						
					$recordCount++;
			?>
			<td>
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td class="eventPhotoTable" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
							<a href="<?php echo '/uploads/eventLivePhoto/eventLive-'.$eventLiveId.'/'.$fileName ?>" rel="lightbox"><?php echo image_tag('/uploads/eventLivePhoto/eventLive-'.$eventLiveId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
						</td>
					</tr>
				</table>
			</td>
			<?php endforeach; ?>
			<?php if( $recordCount==0 ): ?>
			<div class="textC mt40"><h2>Não existem fotos para este evento!</h2></div>
			<?php endif; ?>
		</tr>
	</table>
</div>