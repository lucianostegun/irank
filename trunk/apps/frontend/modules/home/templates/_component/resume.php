<style>
.homeResume {
	
}

.homeResume .group {
	
	background: 	#C5C5C5;
	font-weight: 	bold;
	padding: 		3 0 3 0;
	border-bottom: 	1px solid #777777
}

</style>
<?php
	$resumeList = People::getResumeBalance();
	$balance    = $resumeList['balance'];
?>


<table class="homeResume" width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#FFFFFF" style="border: 1px solid #999">  
  <tr>
    <td align="left" valign="top" bgcolor="#F0F0F0">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td align="left" valign="middle" class="poker_heading">
	        	<?php echo image_tag('frontend/layout/bullet.gif') ?>Resumo de sua conta
	        </td>
			<td class="poker_heading" style="font-size: 13pt; color: #777777; font-weight: bold; text-align: right">Saldo:</td>
			<td width="100" class="poker_heading" style="font-size: 13pt; color: <?php echo ($balance<0?'#DD4444':'#4444DD') ?>; font-weight: bold; padding-left: 10px"><?php echo Util::formatFloat($balance, true) ?></td>
	      </tr>
	      <tr>
	        <td colspan="3">
		        <table width="100%" border="0" cellspacing="0" cellpadding="5">
		          <tr>
		          	<td width="20%" align="center" class="group">Bankroll</td>
		          	<td width="20%" align="center" class="group" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF">Números</td>
		          	<td width="60%" align="center" class="group">Eventos</td>
		          </tr>
		          <tr>
		          	<td align="center" valign="top"><?php include_partial('home/resume/bankroll', $resumeList); ?></td>
		          	<td align="center" valign="top" style="border-left: 1px solid #FFFFFF; border-right: 1px solid #FFFFFF"><?php include_partial('home/resume/numbers', $resumeList); ?></td>
		          	<td align="left" valign="top"><?php include_partial('home/resume/events'); ?></td>
		          </tr>
		        </table>
	        </td>
	      </tr>
	    </table>
    </td>
  </tr>
</table>



    <table style="display:none" Swidth="100%" height="230" border="0" cellspacing="0" cellpadding="0" class="homeResume">
      <tr>
        <td colspan="3" class="title">Resumo de sua conta</td>
      </tr>
      <tr>
        <td>

        </td>
        <td>
        	estatísticas.<br/>
        		Eventos<br/>
        		Rankings<br/>
        		Comentários<br/>
        		Fotos<br/>
        </td>
        <td>
        	próximos eventos<br/>
        	últimos eventos<br/>
        </td>
      </tr>
    </table>