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
	
    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

			$this->postOnWall();
			
			parent::save();
			
       		Log::quickLog('event_player', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_player', $this->getPrimaryKey(), $e);
        }
    }
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event_player', $this->getPrimaryKey());
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
	  	
	  	
		$infoList = $eventObj->getInfo();
		$infoList['playerList'] = $playerList;
		$infoList['peopleName'] = $this->getPeople()->getFirstName();

		$emailContentList['pt_BR'] = Report::replace(AuxiliarText::getContentByTagName('confirmPresenceNotify', false, 'pt_BR'), $infoList);
		$emailContentList['en_US'] = Report::replace(AuxiliarText::getContentByTagName('confirmPresenceNotify', false, 'en_US'), $infoList);
		$emailSubjectList['pt_BR'] = __('email.subject.presenceConfirm', null, 'messages', 'pt_BR');
		$emailSubjectList['en_US'] = __('email.subject.presenceConfirm', null, 'messages', 'en_US');

		$emailAddressList = $eventObj->getEmailAddressList('receiveFriendEventConfirmNotify');

	  	foreach($eventPlayerObjList as $eventPlayerObj){
		
			$peopleObj    = $eventPlayerObj->getPeople();
			$emailAddress = $peopleObj->getEmailAddress();

			if( !in_array($emailAddress, $emailAddressList) )
				continue;
				
			$defaultLanguage = $peopleObj->getDefaultLanguage();
			$emailContent    = $emailContentList[$defaultLanguage];
			$emailSubject    = $emailSubjectList[$defaultLanguage];
			
			Report::sendMail($emailSubject, $emailAddress, $emailContent);
	  	}
	}
	
	public function confirmPresence(){
		
		$this->togglePresence('yes', true);
	}
	
	public function togglePresence($choice, $forceNotify=null){
	
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
			$eventObj->save();
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
			$eventObj->save();
		}
		
		if( $choice=='maybe' ){
			
			$sendNotify = false;
			
			if( $this->getEnabled() ){
				
				$eventObj->setPlayers( $eventObj->getPlayers()-1 );
				$eventObj->save();
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
			$eventObj->save();
		} 
		
		$this->setDeleted(false);
		$this->setConfirmCode( $this->getConfirmCode() );
		$this->setInviteStatus($choice);
		$this->save();
			
		if( $sendNotify && $forceNotify!==false )
			$this->notifyConfirm();
	}
	
	public function getConfirmCode(){
		
		$confirmCode = parent::getConfirmCode();
		
		if( !$confirmCode )
			$confirmCode = base64_encode(strrev(md5($this->getEvent()->getRankingId().'.'.$this->getEventId().'.'.$this->getPeopleId())));
		
		return $confirmCode;
	}
	
	public function postOnWall(){

		$inviteStatus = $this->isColumnModified( EventPlayerPeer::INVITE_STATUS );
		
		if( $inviteStatus && $this->getEnabled() )
       		HomeWall::doLog('confirmou presença no evento <b>'.$this->getEvent()->getEventName().'</b>', 'eventPlayer', true, null, $this->getPeople()->getFirstName());

		if( $inviteStatus && $this->getInviteStatus()=='no' )
       		HomeWall::doLog('não vai ao evento <b>'.$this->getEvent()->getEventName().'</b>', 'eventPlayer', true, null, $this->getPeople()->getFirstName());
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
