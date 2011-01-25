<div class="commonBar"><span><?php echo __('resume.accountResume'); ?></span></div>

<?php
	$peopleId = MyTools::getAttribute('peopleId');
	
	$resumeList = People::getResumeBalance();
	$rankings   = $resumeList['rankings'];
	
	$userSiteObj      = UserSite::getCurrentUser();
	$rankingObjList   = $userSiteObj->getRankingList();
	$eventObjListNext = Event::getNextList(3);
	$eventObjListPrev = Event::getPreviousList(5);
?>
<table cellspacing="0" cellpadding="3" class="resumeTable">
	<tr>
		<td valign="top"><?php include_partial('home/resume/rankings', array('peopleId'=>$peopleId, 'rankingObjList'=>$rankingObjList)) ?></td>
		<td valign="top"><?php include_partial('home/resume/bankRoll', $resumeList); ?></td>
		<td valign="top"><?php include_partial('home/resume/numbers', $resumeList); ?></td>
	</tr>
	<tr>
		<td valign="top" colspan="3"><?php include_partial('home/resume/nextEvents', array('eventObjList'=>$eventObjListNext)) ?></td>
	</tr>
	<tr>
		<td valign="top" colspan="3"><?php include_partial('home/resume/previousEvents', array('peopleId'=>$peopleId, 'eventObjList'=>$eventObjListPrev)) ?></td>
	</tr>
	<tr>
	</tr>
</table>