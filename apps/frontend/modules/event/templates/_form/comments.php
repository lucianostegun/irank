<table width="100%" cellspacing="0" cellpadding="0" style="margin-top: 5px">
	<tr>
		<td valign="top" height="20" style="padding: 5 5 5 15"><div id="commentTitleDiv">Comentários dos convidados para o evento</div></td>
		<?php if( $eventObj->isPastDate() ): ?>
		<td valign="top" rowspan="3" align="left" class="defaultForm" style="padding-bottom: 30px">
			<?php include_partial('event/include/photo', array('eventObj'=>$eventObj)) ?>			
		</td>
		<?php endif; ?>
	</tr>
	<tr>
		<td valign="top" height="50" class="defaultForm">

			<?php include_partial('event/include/commentForm', array('eventCommentId'=>'')) ?>
			
			<div style="display: none" id="extraCommentFormDiv">
				<?php include_partial('event/include/commentForm', array('eventCommentId'=>'%eventCommentId%')) ?>
			</div>
			
		</td>
	</tr>
	<tr>
		<td valign="top" width="420" class="defaultForm" style="padding-bottom: 30px">
			<div id="commentListDiv" class="commentList">
			<?php include_partial('event/include/commentList', array('eventObj'=>$eventObj)); ?>
			</div>
			<div id="commentPhotoListDiv" class="commentList"></div>
		</td>
	</tr>
</table>