<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('frontend/layout/bullet.gif') ?>Meus Rankings</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	      <tr class="rank_heading">
	        <td width="200">Nome</td>
	        <td>Estilo</td>
	        <td>Início</td>
	        <td>Término</td>
	        <td>Buy-in</td>
	        <td>Membros</td>
	        <td>Eventos</td>
	      </tr>
	      <?php
	      	$rankingObjList = $userSiteObj->getRankingList();
	      	foreach($rankingObjList as $rankingObj):
	      		
	      		$link = 'goModule(\'ranking\', \'edit\', \'rankingId\', '.$rankingObj->getId().')';
	      ?>
	      <tr class="recordRow" onclick="<?php echo $link ?>" onmouseover="this.className='recordRowOver'" onmouseout="this.className='recordRow'">
	        <td class="recordCell" align="left"><?php echo $rankingObj->getRankingName() ?></td>
	        <td class="recordCell" align="left"><?php echo $rankingObj->getGameStyle()->getDescription() ?></td>
	        <td class="recordCell" align="left"><?php echo $rankingObj->getStartDate('d/m/Y') ?></td>
	        <td class="recordCell" align="left"><?php echo $rankingObj->getFinishDate('d/m/Y') ?></td>
	        <td class="recordCell" align="right"><?php echo Util::formatFloat($rankingObj->getDefaultBuyin(), true) ?></td>
	        <td class="recordCell" align="left"><?php echo $rankingObj->getPlayers() ?></td>
	        <td class="recordCell" align="left"><?php echo $rankingObj->getEvents() ?></td>
	      </tr>
	      <?php
	      	endforeach;
	      	
	      	if( count($rankingObjList)==0 ):
	      ?>
		  <tr class="boxcontent">
		    <td colspan="7">Você não está inscrito em nenhum ranking</td>
		  </tr>
	      <?php endif; ?>
	    </table>
	</td>
  </tr>
</table>
<div class="buttonBarForm" style="border: 0px transparent">
	<?php echo button_tag('addRanking', 'Novo ranking', array('onclick'=>'goModule("ranking", "new")')) ?>
	<?php echo getFormLoading('ranking') ?>
</div>