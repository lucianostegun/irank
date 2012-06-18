<table cellspacing="3" cellpadding="0" border="0" class="eventPhotoTable">
	<tr>
		<?php
			$eventId = $eventObj->getId();
			$col     = 0;
			
			foreach($eventObj->getPhotoList() as $eventPhotoObj):
				
				$eventPhotoId = $eventPhotoObj->getId();
				$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());
				$comments     = $eventPhotoObj->getCommentsCount();
				
				if( $col > 0 && $col%3==0 )
					echo '</tr><tr>';
					
				$col++;
		?>
		<td onmouseover="this.addClassName('over')" onmouseout="this.removeClassName('hover')">
			
			<?php
				if( $eventObj->isMyEvent() )
					echo image_tag('icon/delete12', array('onclick'=>'deleteEventPhoto('.$eventPhotoId.')', 'class'=>'deleteImage', 'title'=>__('event.commentsTab.deletePhoto')));
				
				echo image_tag('misc/comments', array('onclick'=>'loadEventPhotoComments('.$eventPhotoId.')', 'class'=>'commentImage', 'title'=>__('event.commentsTab.showPhotoComments')));
				
				$imageThumbPath = '/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName;
				$imagePath      = '/uploads/eventPhoto/event-'.$eventId.'/'.$fileName;
				if( !file_exists(Util::getFilePath($imageThumbPath)))
					$imageThumbPath = 'unavailable';
				
				$link = link_to('('.$comments.') comentário'.($comments=='1'?'':'s'), '#loadEventPhotoComments('.$eventPhotoId.')');
				$link = utf8_decode($link);
				$link = htmlentities($link);
			?>
			<a href="<?php echo $imagePath ?>" alt="<?php echo $link ?>" rel="lightbox"><?php echo image_tag($imageThumbPath, array('width'=>80, 'height'=>60)) ?></a>
		</td>
		<?php endforeach ?>
	</tr>
</table>

