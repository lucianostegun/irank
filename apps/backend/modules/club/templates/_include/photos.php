	<ul class="photoList">
		<?php
			$criteria = new Criteria();
			$criteria->add( ClubPhotoPeer::CLUB_ID, $clubId );
			$criteria->add( ClubPhotoPeer::DELETED, false );
			$criteria->addDescendingOrderByColumn( ClubPhotoPeer::CREATED_AT );
			$clubPhotoObjList = ClubPhotoPeer::doSelect($criteria);
			
			foreach($clubPhotoObjList as $clubPhotoObj):
							
				$clubPhotoId = $clubPhotoObj->getId();
				$fileName     = Util::getFileName($clubPhotoObj->getFile()->getFilePath());
		?>
		<li id="clubPhoto-<?php echo $clubPhotoId ?>">
			<a href="<?php echo '/uploads/clubPhoto/club-'.$clubId.'/'.$fileName ?>" class="lightbox"><?php echo image_tag('/uploads/clubPhoto/club-'.$clubId.'/thumb/'.$fileName, array('width'=>100)) ?></a>
			<?php echo link_to(image_tag('backend/icons/control/16/busy'), '#removeClubPhoto('.$clubPhotoId.')', array('class'=>'remove', 'title'=>'Remover esta imagem')) ?>
		</li>
		<?php endforeach; ?>
	</ul>