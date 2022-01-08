<?php
	$eventCommentId = $eventCommentObj->getId();
?>
<div class="commentArea" id="eventComment<?php echo $eventCommentId ?>Div">
	<div class="comment">
		<div class="header">
			<div class="senderInfo"><b><?php echo $eventCommentObj->getPeople()->getName() ?></b> - <?php echo $eventCommentObj->getTimeAgo() ?> atrás</div>
			<div class="delete">
				<?php if( $eventCommentObj->isMyComment() ): ?>
				<?php echo link_to(image_tag('icon/delete10light', array('onmouseover'=>'changeIcon(this, true)', 'onmouseout'=>'changeIcon(this, false)')), '#deleteComment('.$eventCommentId.')', array('title'=>'Excluir este comentário')) ?>
				<?php endif; ?>
			</div>
			<div class="reply"><?php echo link_to('Responder', '#replyComment('.$eventCommentId.')') ?></div>
		</div>
		<div class="message"><?php echo $eventCommentObj->getComment(true) ?></div>
	</div>
</div>