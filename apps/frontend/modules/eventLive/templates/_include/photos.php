<div align="center">
	<table cellspacing="15" cellpadding="0" border="0">
		<tr>
			<?php
				$eventLiveId = $eventLiveObj->getId();
				
				$criteria = new Criteria();
				$criteria->add( EventLivePhotoPeer::EVENT_LIVE_ID, $eventLiveId );
				$criteria->add( EventLivePhotoPeer::DELETED, false );
				$criteria->addDescendingOrderByColumn( EventLivePhotoPeer::CREATED_AT );
				$eventLivePhotoObjList = EventLivePhotoPeer::doSelect($criteria);
				
				$col = 0;
				foreach($eventLivePhotoObjList as $eventLivePhotoObj):
								
					$eventLivePhotoId = $eventLivePhotoObj->getId();
					$fileName     = Util::getFileName($eventLivePhotoObj->getFile()->getFilePath());
					
					if( $col > 0 && $col%6==0 )
						echo '</tr><tr>';
						
					$col++;
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
			<?php
				endforeach;
			?>
		</tr>
	</table>
</div>