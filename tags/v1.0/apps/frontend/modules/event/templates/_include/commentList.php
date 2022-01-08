			<?php
				$commentCount        = $eventObj->getCommentCount();
				$eventCommentObjList = $eventObj->getCommentList(($commentCount>5?5:null));
				$eventCommentObjList = array_reverse($eventCommentObjList);
				
				if( $commentCount > 5 ):
			?>
			<div class="comment" style="padding-top: 5px; margin-bottom: 2px;">
				<?php echo link_to(image_tag('frontend/comments', array('align'=>'absmiddle', 'style'=>'margin: 0 5 0 5')).' Exibir todos os '.$commentCount.' comentários', '#showAllComments()') ?>
			</div>
			<?php
				endif;
				
				foreach($eventCommentObjList as $eventCommentObj)
					include_partial('event/include/comment', array('eventCommentObj'=>$eventCommentObj))
			?>