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

		Util::getHelper('I18N');

		$eventObj = $this->getEvent();
		
		$nl         = chr(10);
		$playerList = '';

		$eventPlayerObjList = $eventObj->getPlayerList();

	  	foreach($eventPlayerObjList as $key=>$eventPlayerObj){
		
			if( !$eventPlayerObj->getEnabled() )
				continue;
			
			$peopleObj = $eventPlayerObj->getPeople();
			
			$playerList .= '  <tr class="boxcontent">'.$nl;
			$playerList .= '    <td style="background: #606060">'.$peopleObj->getName().'</td>'.$nl;
			$playerList .= '  </tr>'.$nl;
	  	}
	  	
	  	$templateName = 'confirmPresenceNotify';
	  	
	  	$optionList = array('templateName'=>$templateName);
	  	
		$infoList = $eventObj->getInfo();
		$infoList['playerList'] = $playerList;
		$infoList['peopleName'] = $this->getPeople()->getFirstName();

		$emailContentList['pt_BR'] = Report::replace(EmailTemplate::getContentByTagName($templateName, false, 'pt_BR'), $infoList);
		$emailContentList['en_US'] = Report::replace(EmailTemplate::getContentByTagName($templateName, false, 'en_US'), $infoList);
		$emailSubjectList['pt_BR'] = __('email.subject.presenceConfirm', null, 'messages', 'pt_BR');
		$emailSubjectList['en_US'] = __('email.subject.presenceConfirm', null, 'messages', 'en_US');

		$emailAddressList = $eventObj->getEmailAddressList('confirmPresenceNotify');

	  	foreach($eventPlayerObjList as $eventPlayerObj){
		
			$peopleObj    = $eventPlayerObj->getPeople();
			$emailAddress = $peopleObj->getEmailAddress();

			if( !in_array($emailAddress, $emailAddressList) )
				continue;
				
			$defaultLanguage = $peopleObj->getDefaultLanguage();
			$emailContent    = $emailContentList[$defaultLanguage];
			$emailSubject    = $emailSubjectList[$defaultLanguage];
			
			Report::sendMail($emailSubject, $emailAddress, $emailContent, $optionList);
	  	}
	}
	
	public function confirmPresence(){
		
		$this->togglePresence('yes', true);
	}
	
	public function togglePresence($choice, $forceNotify=null, $con=null){
	
		$eventObj   = $this->getEvent();
		$sendNotify = false;
		
		$inviteStatus = $this->getInviteStatus();
		
		if( $inviteStatus==$choice )
			return;
		
		if( $choice=='yes' && !$this->getEnabled() ){
		
			$eventDate = $eventObj->getEventDate('Y-m-d').' '.$eventObj->getStartTime('H:i');
		
			$sendNotify = (strtotime($eventDate) > time());

			$this->setEnabled(true);
			
			$eventObj->setPlayers( $eventObj->getPlayers()+1 );
			$eventObj->save($con);
		}
		
		if( $choice=='no' && $this->getEnabled() ){
			
			$sendNotify = false;
			
			$this->setEventPosition(0);
			$this->setPrize(0);
			$this->setRebuy(0);
			$this->setAddon(0);
			$this->setBuyin(0);
			$this->setEnabled(false);
			
			$eventObj->setPlayers( $eventObj->getPlayers()-1 );
			$eventObj->save($con);
		}
		
		if( $choice=='maybe' ){
			
			$sendNotify = false;
			
			if( $this->getEnabled() ){
				
				$eventObj->setPlayers( $eventObj->getPlayers()-1 );
				$eventObj->save($con);
			}
			
			$this->setEventPosition(0);
			$this->setPrize(0);
			$this->setRebuy(0);
			$this->setAddon(0);
			$this->setBuyin(0);
			$this->setEnabled(false);
		}
		
		if($choice=='none' && !$this->isNew()){
			
			$sendNotify = false;
			$choice     = $this->getInviteStatus();
			
			$eventObj->setPlayers( $eventObj->getPlayers()-1 );
			$eventObj->save($con);
		} 
		
		$this->setDeleted(false);
		$this->setConfirmCode( $this->getConfirmCode() );
		$this->setInviteStatus($choice);
		$this->save($con);
		
		if( $sendNotify && $forceNotify!==false )
			$this->notifyConfirm();
	}
	
	public function getConfirmCode(){
		
		$confirmCode = parent::getConfirmCode();
		
		if( !$confirmCode )
			$confirmCode = base64_encode(strrev(md5($this->getEvent()->getRankingId().'.'.$this->getEventId().'.'.$this->getPeopleId())));
		
		return $confirmCode;
	}
	
	public function share($save=true){
		
		$this->setAllowEdit( true );
		if( $save )
			$this->save();
	}
	
	public function unshare(){
		
		$this->setAllowEdit( false );
		$this->save();
	}

	public function getInviteStatusDescription(){
		
		Util::getHelper('I18N');
		
		switch($this->getInviteStatus()){
			case 'yes':
				return __('Confirmed');
			default:
				return __('NotConfirmed');
		}
	}
	
	public static function getXml($eventList){
		
		return Util::buildXml($eventList, 'eventPlayers', 'eventPlayer');
	}
}