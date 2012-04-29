<?php include_partial('home/component/commonBar', array('pathList'=>array(__('photoWall.title')=>'photoWall/index'))); ?>

<div class="moduleIntro">
	<?php echo image_tag('photos', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	<?php echo __('photoWall.intro') ?><br/>
	Confira também o <?php echo link_to('Ranking do concurso', 'photoWall/ranking') ?> de fotos <b>iRank</b>
</div>
<div class="clear"></div>
<div align="center">
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
					
					$createdAt    = $eventPhotoObj->getCreatedAt('d/m/Y');
					$username     = $eventPhotoObj->getPeople()->getUserSite()->getUsername();
					$eventName    = $eventPhotoObj->getEvent()->getEventName();
					$photoCaption = 'Foto enviada em <b>'.$createdAt.'</b> pelo usuário <b>'.$username.'</b> registrada para o evento <b>'.$eventName.'</b>';
			?>
			<td>
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td class="eventPhotoTable" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
							<a href="<?php echo '/uploads/eventPhoto/event-'.$eventId.'/'.$fileName ?>" rel="lightbox" title="<?php echo $photoCaption ?>"><?php echo image_tag('/uploads/eventPhoto/event-'.$eventId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
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
</div>