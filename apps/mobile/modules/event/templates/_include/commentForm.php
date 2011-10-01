<?php
	$culture = MyTools::getCulture();
?>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="lastLineBar" valign="top"><?php echo __('event.comment.comment') ?></th>
						<td class="lastLineBar">
						<?php echo textarea_tag('comment', __('event.comment.fieldMessage'), array('onfocus'=>'handleCommentFocus(this)', 'onkeyup'=>'countChars(this)', 'id'=>'commentsComment')) ?>
						</td>
					</tr>
					<tr>
						<td class="actionBar" align="right" colspan="2" id="commentButtonBarDiv" style="display: none">
							<table cellpadding="0" cellspacing="0" width="100%" class="clean">
								<tr>
									<td align="left" id="commentsCharCount">140 <?php echo __('leftChars') ?></td>
									<td align="right"><?php echo image_tag('mobile/button/'.$culture.'/publish', array('onclick'=>'sendComment()')) ?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>