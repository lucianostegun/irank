<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('frontend/layout/bullet.gif') ?>Eventos</td>
  </tr>
  <tr>
    <td align="left" valign="top">
    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	      <tr class="rank_heading">
	        <td>Evento</td>
	        <td>Ranking</td>
	        <td>Data/Hora</td>
	      </tr>
	      <?php
			include_partial('event/include/search', array('criteria'=>$criteria));
	      ?>
	    </table>
	    * Eventos criados para seus rankings
	</td>
  </tr>
</table>
