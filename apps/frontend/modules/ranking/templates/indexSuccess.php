<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('frontend/layout/bullet.gif') ?>Meus Rankings</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	      <tr class="rank_heading">
	        <td width="200">Nome</td>
	        <td>Início</td>
	        <td>Término</td>
	        <td>Membros</td>
	        <td>Eventos</td>
	      </tr>
	      <?php
	      	$rankingObjList = $userSiteObj->getRankingList();
	      	foreach($rankingObjList as $rankingObj):
	      ?>
	      <tr class="boxcontent">
	        <td><?php echo link_to($rankingObj->getRankingName(), '#goModule(\'ranking\', \'edit\', \'rankingId\', '.$rankingObj->getId().')') ?></td>
	        <td><?php echo $rankingObj->getStartDate('d/m/Y') ?></td>
	        <td><?php echo $rankingObj->getFinishDate('d/m/Y') ?></td>
	        <td><?php echo $rankingObj->getMembers() ?></td>
	        <td><?php echo $rankingObj->getEvents() ?></td>
	      </tr>
	      <?php
	      	endforeach;
	      	
	      	if( count($rankingObjList)==0 ):
	      ?>
		  <tr class="boxcontent">
		    <td colspan="5">Você não está inscrito em nenhum ranking</td>
		  </tr>
	      <?php endif; ?>
	    </table>
	</td>
  </tr>
</table>