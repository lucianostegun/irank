<table cellspacing="3" cellpadding="0" border="0" class="eventPhotoTable">
	<tr>
		<?php
			$eventId = $eventObj->getId();
			$col     = 0;
			
			foreach($eventObj->getPhotoList() as $eventPhotoObj):
				
				$eventPhotoId = $eventPhotoObj->getId();
				$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());
				
				if( $col > 0 && $col%3==0 )
					echo '</tr><tr>';
					
				$col++;
		?>
		<td onmouseover="this.className='over'" onmouseout="this.className=''">
			
			<?php
				if( $eventObj->isMyEvent() )
					echo image_tag('icon/delete12', array('onclick'=>'deleteEventPhoto('.$eventPhotoId.')', 'class'=>'deleteImage', 'title'=>__('event.commentsTab.deletePhoto')));
				
				echo image_tag('misc/comments', array('onclick'=>'loadEventPhotoComments('.$eventPhotoId.')', 'class'=>'commentImage', 'title'=>__('event.commentsTab.showPhotoComments')));
				
				$imagePath = '/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName;
				if( !file_exists(Util::getFilePath($imagePath)))
					$imagePath = 'unavailable';
					
				echo image_tag($imagePath, array('width'=>80, 'height'=>60, 'onclick'=>'viewEventPhoto('.$eventPhotoId.')'));
			?>
		</td>
		<?php endforeach ?>
	</tr>
</table>