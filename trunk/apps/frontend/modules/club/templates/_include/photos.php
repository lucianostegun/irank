<div align="center">
	<table cellspacing="15" cellpadding="0" border="0">
		<tr>
			<?php
				$clubId = $clubObj->getId();
				
				$criteria = new Criteria();
				$criteria->add( ClubPhotoPeer::CLUB_ID, $clubId );
				$criteria->add( ClubPhotoPeer::DELETED, false );
				$criteria->addDescendingOrderByColumn( ClubPhotoPeer::CREATED_AT );
				$clubPhotoObjList = ClubPhotoPeer::doSelect($criteria);
				
				$recordCount = 0;
				foreach($clubPhotoObjList as $clubPhotoObj):
								
					$clubPhotoId = $clubPhotoObj->getId();
					$fileName     = Util::getFileName($clubPhotoObj->getFile()->getFilePath());
					
					if( $recordCount > 0 && $recordCount%6==0 )
						echo '</tr><tr>';
						
					$recordCount++;
			?>
			<td>
				<table cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td class="eventPhotoTable" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
							<a href="<?php echo '/uploads/clubPhoto/club-'.$clubId.'/'.$fileName ?>" rel="lightbox"><?php echo image_tag('/uploads/clubPhoto/club-'.$clubId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
						</td>
					</tr>
				</table>
			</td>
			<?php endforeach; ?>
			<?php if( $recordCount==0 ): ?>
			Não existem fotos para este clube
			<?php endif; ?>
		</tr>
	</table>
</div>