<?php

/**
 * Subclasse de representação de objetos da tabela 'event_player'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventPlayer extends BaseEventPlayer
{
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
	}
	
	public function notifyConfirm(){

		$eventObj     = $this->getEvent();
		$emailContent = AuxiliarText::getContentByTagName('confirmPresenceNotify');

		$emailContent = $eventObj->getEmailContent($emailContent);
		
		$emailContent = str_replace('<peopleName>', $this->getPeople()->getName(), $emailContent);
		
		$nl         = chr(10);
		$playerList = '';

		$eventPlayerObjList = $eventObj->getPlayerList();
	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj){
		
			if( !$eventPlayerObj->getEnabled() )
				continue;
			
			$peopleObj = $eventPlayerObj->getPeople();
			
			$playerList .= '  <tr class="boxcontent">'.$nl;
			$playerList .= '    <td style="background: #1B4315">'.$peopleObj->getName().'</td>'.$nl;
			$playerList .= '  </tr>'.$nl;
	  	}
	  	
		$emailContent = str_replace('<playerList>', $playerList, $emailContent);
		
		$emailAddressList = $eventObj->getEmailAddressList('receiveFriendEventConfirmNotify');
		
		Report::sendMail('Confirmação de presença', $emailAddressList, $emailContent);
	}
}
