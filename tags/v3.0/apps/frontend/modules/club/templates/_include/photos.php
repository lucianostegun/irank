<div class="textC">
	<table cellspacing="15" cellpadding="0" border="0">
		<tr>
			<?php
				$clubId = $clubObj->getId();
				
				$recordCount = 0;
				foreach($clubObj->getClubPhotoList() as $clubPhotoObj):
								
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
			<div class="textC mt40"><h2>Não existem fotos para este clube!</h2></div>
			<?php endif; ?>
		</tr>
	</table>
</div>