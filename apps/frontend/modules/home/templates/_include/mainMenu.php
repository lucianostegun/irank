<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" style="border: 1px solid #999">
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

<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" style="margin-top: 5px; border: 1px solid #999">  
  <tr>
    <td align="left" valign="top" bgcolor="#F0F0F0">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td align="left" valign="middle" class="poker_heading"><?php echo image_tag('frontend/layout/bullet.gif') ?>Meu menu</td>
	      </tr>
	      <tr>
	        <td align="left" valign="top" class="poker" style="padding:11px 0px 20px 12px;">
		        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		          <tr><td style="font-weight: bold"><?php echo link_to('Novo ranking', 'ranking/new') ?></td></tr>
		          <tr><td><?php echo link_to('Meus rankings', 'ranking/index') ?></td></tr>
		          <tr><td style="font-weight: bold"><?php echo link_to('Novo evento', 'event/new') ?></td></tr>
		          <tr><td><?php echo link_to('Eventos', 'event/index') ?></td></tr>
		          <tr><td style="padding-top: 20px; background: url('/images/icon/stats.png') left 26px no-repeat"><?php echo link_to('Estatísticas', 'statistic/index', array('style'=>'background: none')) ?></td></tr>
		          <tr><td style="background: url('/images/icon/options.png') left 7px no-repeat"><?php echo link_to('Configurações', 'sign/options', array('style'=>'background: none')) ?></td></tr>
		        </table>
	        </td>
	      </tr>
	    </table>
    </td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" style="margin-top: 5px; border: 1px solid #999">  
  <tr>
    <td align="left" valign="top" bgcolor="#F0F0F0">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td align="left" valign="middle" class="poker_heading"><img src="/images/frontend/layout/bullet.gif" alt="" width="40" height="10" />Canais iRank</td>
	      </tr>
	      <tr>
	        <td align="left" valign="top" class="poker" style="padding:11px 0px 20px 12px;">
		        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		          <tr>
		          	<td style="background: url('/images/icon/photo.png') left 6px no-repeat"><?php echo link_to('Mural de fotos', 'photoWall/index', array('style'=>'background: none')) ?></td>
		          </tr>
		        </table>
	        </td>
	      </tr>
	    </table>
    </td>
  </tr>
</table>