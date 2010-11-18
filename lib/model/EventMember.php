<?php

/**
 * Subclasse de representação de objetos da tabela 'event_member'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventMember extends BaseEventMember
{
	
	public function notifyConfirm(){

		$eventObj     = $this->getEvent();
		$emailContent = AuxiliarText::getContentByTagName('confirmPresenceNotify');

		$emailContent = $eventObj->getEmailContent($emailContent);
		
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getName(), $emailContent);
		
		$nl         = chr(10);
		$memberList = '';

		$eventMemberObjList = $eventObj->getMemberList();
	  	foreach($eventMemberObjList as $key=>$eventMemberObj){
		
			if( !$eventMemberObj->getEnabled() )
				continue;
			
			$peopleObj = $eventMemberObj->getPeople();
			
			$memberList .= '  <tr class="boxcontent">'.$nl;
			$memberList .= '    <td style="background: #1B4315">'.$peopleObj->getName().'</td>'.$nl;
			$memberList .= '  </tr>'.$nl;
	  	}
	  	
		$emailContent = str_replace('<memberList>', $memberList, $emailContent);
		
		$emailAddressList = $eventObj->getEmailAddressList('receiveFriendEventConfirmNotify');
		
		Report::sendMail('Confirmação de presença', $emailAddressList, $emailContent);
	}
}
