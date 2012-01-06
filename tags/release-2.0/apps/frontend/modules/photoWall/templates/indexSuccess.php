<div class="commonBar"><span><?php echo __('photoWall.title') ?></span></div>

<div class="innerContent">
	<?php echo image_tag('photos', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	<?php echo __('photoWall.intro') ?>
	<br/><br/>
</div>

<table cellspacing="15" cellpadding="0" border="0">
	<tr>
		<?php
			$criteria = new Criteria();
			$criteria->add( EventPhotoPeer::IS_SHARED, true );
			$criteria->add( EventPhotoPeer::DELETED, false );
			$criteria->addDescendingOrderByColumn( EventPhotoPeer::CREATED_AT );
			$eventPhotoObjList = EventPhotoPeer::doSelect($criteria);
			
			$col        = 0;
			$commentRow = 0;
			foreach($eventPhotoObjList as $eventPhotoObj):
							
				$eventPhotoId = $eventPhotoObj->getId();
				$eventId      = $eventPhotoObj->getEventId();
				$fileName     = Util::getFileName($eventPhotoObj->getFile()->getFilePath());
				
				if( $col > 0 && $col%6==0 )
					echo '</tr><tr id="commentRow'.($commentRow++).'" style="display: none"><td colspan="6">----</td></tr><tr>';
					
				$col++;
		?>
		<td>
			<table cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td class="eventPhotoTable" onmouseover="this.className='eventPhotoTableOver'" onmouseout="this.className='eventPhotoTable'">
						<?php
							echo image_tag('misc/comments', array('onclick'=>'loadEventPhotoComments('.$eventPhotoId.')', 'class'=>'commentImage', 'title'=>__('event.commentsTab.showPhotoComments')));
								
							echo image_tag('/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName, array('width'=>80, 'onclick'=>'viewEventPhoto('.$eventPhotoId.')'));
						?>
					</td>
				</tr>
			</table>
		</td>
		<?php
			endforeach;
		?>
	</tr>
	<tr id="commentRow<?php echo $commentRow++ ?>" style="display: none">
		<td colspan="6"></td>
	</tr>
</table>

<?php
	DhtmlxWindows::createWindow('photoWallView', '', 380, 125, 'photoWall/dialog/photoView', array());
?>