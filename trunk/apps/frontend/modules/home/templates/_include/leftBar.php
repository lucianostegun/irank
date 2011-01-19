<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" style="display: none; margin-top: 5px; border: 1px solid #999">
  <tr>
    <td align="left" valign="top" bgcolor="#F0F0F0">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td align="left" valign="middle" class="poker_heading">
	        	<?php echo image_tag('frontend/layout/bullet.gif') ?>Encontrar amigos</td>
	      </tr>
	      <tr>
	        <td align="left" valign="top" class="poker" style="padding:11px 0px 20px 12px;">
	            <?php
					echo form_tag('friendSearch/search', array('id'=>'friendSearchForm'));
				?>
		        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		          <tr><td style="padding: 5 0 5 0">Username/E-mail</td></tr>
		          <tr><td style="padding: 0 10 0 0"><?php echo input_tag('keyWord', null, array('style'=>'width: 100%')) ?></td></tr>
		          <tr><td style="padding: 5 0 0 0" align="right"><?php echo button_tag('searchFriend', 'Procurar amigos', array('onclick'=>'doSearchFriends()', 'style'=>'float: right')) ?></td></tr>
		        </table>
		        </form>
	        </td>
	      </tr>
	    </table>
    </td>
  </tr>
</table>

<div class="separator"></div>
<div class="item" style="background: url('/images/icon/photo.png') 10px 4px no-repeat"><?php echo link_to('Mural de fotos', 'photoWall/index', array('style'=>'background: none')) ?></div>
<div class="separator"></div>