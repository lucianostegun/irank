	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>

	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="lastLineBar" valign="top">Comentário</th>
						<td class="lastLineBar">
						<?php echo textarea_tag('comment', 'Clique aqui para enviar seu comentário', array('onfocus'=>'handleCommentFocus(this)', 'onkeyup'=>'countChars(this)', 'id'=>'commentsComment')) ?>
						</td>
					</tr>
					<tr>
						<td class="actionBar" align="right" colspan="2" id="commentButtonBarDiv" style="display: none">
							<table cellpadding="0" cellspacing="0" width="100%" class="clean">
								<tr>
									<td align="left" id="commentsCharCount">140 caracteres restantes</td>
									<td align="right"><?php echo image_tag('mobile/button/publish', array('onclick'=>'sendComment()')) ?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeft', array('id'=>'commentBaseLeft')) ?></td>
			<td width="100%" class="baseMiddle" id="commentBaseMiddle"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRight', array('id'=>'commentBaseRight')) ?></td>
		</tr>
	</table>