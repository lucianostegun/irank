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
	
	public function confirmPresence(){
		
		$this->togglePresence('yes', true);
	}
	
	public function togglePresence($choice, $forceNotify=null){
	
		$eventObj   = $this->getEvent();
		$sendNotify = false;
		
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
			
			$this->setEventPosition(0);
			$this->setPrize(0);
			$this->setRebuy(0);
			$this->setAddon(0);
			$this->setBuyin(0);
			$this->setEnabled(false);
			
			if( $this->getEnabled() ){
				
				$eventObj->setPlayers( $eventObj->getPlayers()-1 );
				$eventObj->save();
			}
		}
		
		if($choice=='none' && !$this->isNew()){
			
			$sendNotify = false;
			$choice     = $this->getInviteStatus();
		} 
		
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
       		HomeWall::doLog('confirmou presença no evento <b>'.$this->getEvent()->getEventName().'</b>', 'eventPlayer', true, $this->getPeople()->getUserSiteId());
		
		if( $inviteStatus && $this->getInviteStatus()=='no' )
       		HomeWall::doLog('não vai ao evento <b>'.$this->getEvent()->getEventName().'</b>', 'eventPlayer', true, $this->getPeople()->getUserSiteId());
	}

	public function getInviteStatusDescription(){
		
		switch($this->getInviteStatus()){
			case 'yes':
				return 'Confirmado';
			default:
				return 'Não confirmado';
		}
	}
}