<table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" style="border: 1px solid #999">
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
		          <tr><td style="padding-top: 20px; background: url('/images/icon/stats.png') left 26px no-repeat"><?php echo link_to('Estatísticas', 'stats/index', array('style'=>'background: none')) ?></td></tr>
		          <tr><td style="background: url('/images/icon/options.png') left 7px no-repeat"><?php echo link_to('Configurações', 'sign/options', array('style'=>'background: none')) ?></td></tr>
		        </table>
	        </td>
	      </tr>
	    </table>
    </td>
  </tr>
  
  <tr>
    <td align="left" valign="top" bgcolor="#F0F0F0">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top: 1px solid #D0D0D0">
	      <tr>
	        <td align="left" valign="middle" class="poker_heading"><img src="/images/frontend/layout/bullet.gif" alt="" width="40" height="10" />Poker Sites</td>
	      </tr>
	      <tr>
	        <td align="left" valign="top" class="poker" style="padding:11px 0px 20px 12px;">
		        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		          <tr>
		            <td align="left" valign="top"><?php echo link_to('PokerStars', 'http://www.pokerstars.net', array('target'=>'_blank')) ?></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top"><?php echo link_to('Party Poker', 'http://www.partypoker.net', array('target'=>'_blank')) ?></td>
		          </tr>
		          <tr>
		            <td align="left" valign="top"><?php echo link_to('Fulltilt Poker', 'http://www.fulltiltpoker.net', array('target'=>'_blank')) ?></td>
		          </tr>
		        </table>
	        </td>
	      </tr>
	    </table>
    </td>
  </tr>
</table>