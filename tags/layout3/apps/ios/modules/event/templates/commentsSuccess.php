<div class="commentList">
	<?php
		$eventObj = EventPeer::retrieveByPK( $eventId );
	
		$commentCount        = $eventObj->getCommentCount();
		$eventCommentObjList = $eventObj->getCommentList(($commentCount > 15?15:null));
		$eventCommentObjList = array_reverse($eventCommentObjList);
		
		foreach($eventCommentObjList as $key=>$eventCommentObj):
	
			$eventCommentId = $eventCommentObj->getId();
			$isMyComment    = $eventCommentObj->isMyComment();
	?>
	<div class="comment">
		<div class="message"><?php echo $eventCommentObj->getComment(true) ?></div>
		<span class="senderName"><?php echo $eventCommentObj->getPeople()->getName() ?></span>
		<span class="commentDate"><?php echo $eventCommentObj->getCreatedAt('d/m/Y H:s') ?></span>
	</div>
	<?php
		endforeach;
		
		if( count($eventCommentObjList)==0 ):
	?>
	<div class="commentArea">
		<div class="comment">
			<div class="message"><?php echo __('event.noComments') ?></div>
		</div>
	</div>
	<?php endif; ?>
</div>
<a id="footer"/>