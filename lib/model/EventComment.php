<?php

/**
 * Subclasse de representação de objetos da tabela 'event_comment'.
 *
 * 
 *
 * @package lib.model
 */ 
class EventComment extends BaseEventComment
{
	
	public function delete($con=null){
		
		$this->setDeleted(true);
		$this->save();
		
		Log::quickLogDelete('event_comment', $this->getPrimaryKey());
	}

    public function save($con=null){
    	
    	try{
			
			$isNew              = $this->isNew();
			$columnModifiedList = Log::getModifiedColumnList($this);

    		$this->postOnWall();

			parent::save();
			
       		Log::quickLog('event_comment', $this->getPrimaryKey(), $isNew, $columnModifiedList, get_class($this));
        } catch ( Exception $e ) {
        	
            Log::quickLogError('event_comment', $this->getPrimaryKey(), $e);
        }
    }
    
    public function getComment($format=false){
    	
    	$comment = parent::getComment();
    	
		$comment = str_replace('>', '&gt;', $comment);
		$comment = str_replace('<', '&lt;', $comment);
    	
    	if( $format )
    		$comment = str_replace(chr(10), '<br/>', $comment);
		
    	return $comment;
    }
    
    public function getTimeAgo(){
    	
    	return Util::getTimeAgo($this->getCreatedAt(null));
    }
	
	public function isMyComment(){
		
		$peopleId = MyTools::getAttribute('peopleId');
			
		return ($this->getPeopleId()==$peopleId);
	}
	
	public function postOnWall(){
		
		if( !$this->isNew() )
			return false;
			
       	HomeWall::doLog('postou um comentário no evento <b>'.$this->getEvent()->getEventName().'</b>', 'eventComment', true);
	}
	
	public function notify(){

		Util::getHelper('I18N');

		$eventObj     = $this->getEvent();
		$emailSubject = 'email.subject.eventComment';
			
		$infoList['eventName']   = $eventObj->getEventName();
		$infoList['eventPlace']  = $eventObj->getEventPlace();
		$infoList['eventDate']   = $eventObj->getEventDate('d/m/Y');
		$infoList['startTime']   = $eventObj->getStartTime('H:i');
		$infoList['rankingName'] = $eventObj->getRanking()->getRankingName();
		$infoList['peopleName']  = $this->getPeople()->getFirstName();
		$infoList['peopleEmail'] = $this->getPeople()->getEmailAddress();
		$infoList['comment']     = $this->getComment();
		
		$emailAddressInfoList = $eventObj->getEmailAddressList('receiveEventCommentNotify', false, true);

		$emailTemplateObj = EmailTemplatePeer::retrieveByTagName('eventCommentNotify');

		$emailContent = $emailTemplateObj->getContent();
		$emailContent = Report::replace($emailContent, $infoList);
		$emailSubject = __($emailSubject, array('%eventCode%'=>$eventObj->getCode()), 'messages', 'pt_BR');
		
		$optionList = array();
		$optionList['emailTemplateObj'] = $emailTemplateObj;
		$optionList['replyTo']          = 'event_comment@irank.com.br';
		
		foreach($emailAddressInfoList as $emailAddressInfo){

			$emailAddress = $emailAddressInfo['emailAddress'];
			$culture      = $emailAddressInfo['culture'];
			
			Report::sendMail($emailSubject, $emailAddress, $emailContent, $optionList);
		}
	}
}
