<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" style="padding: 5 5 5 15">Comentários dos convidados para o evento</td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm">

			<?php include_partial('event/include/commentForm', array('eventCommentId'=>'')) ?>
			
			<div style="display: none" id="extraCommentFormDiv">
				<?php include_partial('event/include/commentForm', array('eventCommentId'=>'%eventCommentId%')) ?>
			</div>
			
		</td>
	</tr>
	<tr>
		<td valign="top" class="defaultForm" id="commentListDiv" style="padding-bottom: 30px">

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
			
		</td>
	</tr>
</table>